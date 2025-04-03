<?php

namespace App\Service;

use App\Repository\NetworkLog\NetworkLogRepositoryInterface;
use Exception;
use Illuminate\Support\Carbon;
use RouterOS\Client;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class MikrotikService
{
    protected Client $client;

    /**
     * @throws QueryException
     * @throws ConfigException
     * @throws Exception
     */
    public function __construct()
    {
        $config = config('routeros-api');
        try {
            $this->client = new Client([
                'host' => $config['host'],
                'user' => $config['user'],
                'pass' => $config['pass'],
                'port' => $config['port'],
            ]);
        } catch (ClientException $e) {
            throw new Exception('Failed to connect to MikroTik: ' . $e->getMessage());
        }
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getSystemIdentity(): mixed
    {
        try {
            return $this->client->query('/system/identity/print')->read();
        } catch (Exception $e) {
            throw new Exception('Error fetching system identity: ' . $e->getMessage());
        }
    }

    /**
     * @param string $phone
     * @param string $publicIpAddress
     * @return mixed
     * @throws ConfigException
     * @throws QueryException
     * @throws Exception
     */
    public function addNatRule(string $phone, string $publicIpAddress = '213.233.177.228'): mixed
    {
        try {
            $query = new Query('/ip/firewall/nat/add');
            $query->equal('action', "src-nat");
            $query->equal('chain', 'srcnat');
            $query->equal('dst-address-list', "!allowed allways");
            $query->equal('src-address-list', $phone);
            $query->equal('to-addresses', $publicIpAddress);
            return $this->client->query($query)->read();
        } catch (ClientException $e) {
            throw new Exception('Error adding user: ' . $e->getMessage());
        }
    }

    /**
     * @param string $ipAddress
     * @return mixed|null
     * @throws Exception
     */
    public function getUserMACByIP(string $ipAddress): mixed
    {
        try {
            $query = new Query('/ip/dhcp-server/lease/print');
            $query->equal('address', $ipAddress);
            $response = $this->client->query($query)->read();
            if (!empty($response)) {
                return $response[0]['mac-address'] ?? null;
            }
            throw new \Exception('MAC address not found for this IP.');
        } catch (\Exception $e) {
            throw new \Exception('Error fetching MAC address: ' . $e->getMessage());
        }
    }

    /**
     * @param string $phone
     * @return array|null
     * @throws Exception
     */
    public function getUserTraffic(string $phone): ?array
    {
        try {
            $query = new Query('/ip/firewall/nat/print');
            $query->where('src-address-list', $phone);
            $response = $this->client->query($query)->read();
            if (!empty($response)) {
                return $response[0];
            }
            return null;
//            throw new \Exception('User not found or not active.');
        } catch (\Exception $e) {
            throw new \Exception('Error fetching traffic data: ' . $e->getMessage());
        }
    }

    /**
     * @param string $status
     * @param string $phone
     * @return array
     * @throws Exception
     */
    public function blockUserAccess(string $status, string $phone): array
    {
        try {
            $query = new Query("/ip/firewall/nat/$status");
            $query->where('src-address-list', $phone);
            return $this->client->query($query)->read();
        } catch (\Exception $e) {
            throw new \Exception('Error blocking user access: ' . $e->getMessage());
        }
    }

    /**
     * @param string $ip
     * @param string $phone
     * @return mixed
     * @throws Exception
     */
    public function addAddressList(string $ip, string $phone): mixed
    {
        try {
            $query = new Query('/ip/firewall/address-list/add');
            $query->equal('list', $phone);
            $query->equal('address', $ip);
            return $this->client->query($query)->read();
        } catch (\Exception $e) {
            throw new \Exception('Error blocking user access: ' . $e->getMessage());
        }
    }

    /**
     * @param string $ip
     * @param string $phone
     * @return bool
     * @throws Exception
     */
    public function removeAddressList(string $ip, string $phone): bool
    {
        try {
            $query = new Query('/ip/firewall/address-list/print');
            $query->where('list', $phone);
            $query->where('address', $ip);
            $response = $this->client->query($query)->read();
            if (!empty($response)) {
                $id = $response[0]['.id'];
                $deleteQuery = new Query('/ip/firewall/address-list/remove');
                $deleteQuery->equal('.id', $id);
                $this->client->query($deleteQuery)->read();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            throw new \Exception('Error blocking user access: ' . $e->getMessage());
        }
    }

    /**
     * @return int[]
     * @throws Exception
     */
    public function getData(): array
    {
        try {
            $query = new Query('/ip/firewall/nat/print');
            $response = $this->client->query($query)->read();
            if (!empty($response)) {
                return $response[0];
            }
            throw new \Exception('User not found or not active.');
        } catch (\Exception $e) {
            throw new \Exception('Error fetching traffic data: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getNetworkLogUsage(): void
    {
        try {
            $sessionRepositoryInterface=app()->make(NetworkLogRepositoryInterface::class);
            // Get DHCP leases
            $dhcpQuery = new Query('/ip/dhcp-server/lease/print');
            $leases = $this->client->query($dhcpQuery)->read();
            $leasesByIp = collect($leases)->keyBy('address');
            // Get NAT rules
            $natQuery = new Query('/ip/firewall/nat/print');
            $natRules = $this->client->query($natQuery)->read();

            foreach ($natRules as $rule) {
                $addressListName = $rule['src-address-list'] ?? null;
                $bytes = $rule['bytes'] ?? '0/0';

                if (!$addressListName) continue;

                $listQuery = new Query('/ip/firewall/address-list/print');
                $listQuery->equal('list', $addressListName);
                $addressListEntries = $this->client->query($listQuery)->read();

                [$rx, $tx] = explode('/', $bytes);

                foreach ($addressListEntries as $entry) {
                    $ip = $entry['address'] ?? null;
                    $mac = $leasesByIp[$ip]['mac-address'] ?? null;
                    if (!$mac) continue;

                    $sessionRepositoryInterface->startOrUpdateSession($mac, $ip, (int) $rx, (int) $tx);
                }
            }
            // Close sessions that are no longer active
            $activeMacs = collect($leases)->pluck('mac-address')->toArray();
            $sessionRepositoryInterface->closeInactiveSessions($activeMacs);

        } catch (\Exception $e) {
            throw new \Exception('Error tracking session data: ' . $e->getMessage());
        }
    }


    /**
     * @param string $phone
     * @param string $publicIpAddress
     * @return bool
     * @throws Exception
     */
    public  function removeNatRule(string $phone,string $publicIpAddress= '213.233.177.228'): bool
  {
        try {
            $rules=$this->printNatRules($phone,$publicIpAddress);
            if (!empty($rules)) {
                foreach ($rules as $rule) {
                    $id = $rule['.id'];
                    $delete = new Query('/ip/firewall/nat/remove');
                    $delete->equal('.id', $id);
                    $this->client->query($delete)->read();
                }
                return true;
            }
            return false;
        }catch (\Exception $e) {
            throw new \Exception('Error fetching NAT rule: ' . $e->getMessage());
        }

    }

    /**
     * @param string $phone
     * @param string $publicIpAddress
     * @return mixed
     * @throws Exception
     */
    public function printNatRules(string $phone, string $publicIpAddress= '213.233.177.228'): mixed
    {
        try {
            $query = new Query('/ip/firewall/nat/print');
            $query->equal('action', "src-nat");
            $query->equal('chain', 'srcnat');
            $query->equal('dst-address-list', "!allowed allways");
            $query->equal('src-address-list', $phone);
            $query->equal('to-addresses', $publicIpAddress);
            return $this->client->query($query)->read();
        }catch (\Exception $e) {
            throw new \Exception('Error fetching NAT rules: ' . $e->getMessage());
        }

    }


}
