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
            throw new Exception('MAC address not found for this IP.');
        } catch (Exception $e) {
            throw new Exception('Error fetching MAC address: ' . $e->getMessage());
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
        } catch (Exception $e) {
            throw new Exception('Error fetching traffic data: ' . $e->getMessage());
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
        } catch (Exception $e) {
            throw new Exception('Error blocking user access: ' . $e->getMessage());
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
        } catch (Exception $e) {
            throw new Exception('Error blocking user access: ' . $e->getMessage());
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
        } catch (Exception $e) {
            throw new Exception('Error blocking user access: ' . $e->getMessage());
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
            throw new Exception('User not found or not active.');
        } catch (Exception $e) {
            throw new Exception('Error fetching traffic data: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getNetworkLogUsage(): void
    {
        try {
            $query = new Query('/ip/dhcp-server/lease/print');
            $leases = $this->client->query($query)->read();
            $queueQuery = new Query('/queue/simple/print');
            $queues = $this->client->query($queueQuery)->read();
            foreach ($leases as $lease) {
                $mac = $lease['mac-address'] ?? null;
                $ip = $lease['address'] ?? null;
                $matchedQueue = collect($queues)->firstWhere('target', $ip . '/32');
                $rx = $matchedQueue['rx-byte'] ?? 0;
                $tx = $matchedQueue['tx-byte'] ?? 0;
                app()->make(NetworkLogRepositoryInterface::class)->create([
                    'mac_address' => $mac,
                    'ip_address' => $ip,
                    'download_bytes' => $rx,
                    'upload_bytes' => $tx,
                    'logged_at' => Carbon::now(),
                ]);
            }
        } catch (Exception $e) {
            throw new Exception('Error fetching network log usage: ' . $e->getMessage());
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
        }catch (Exception $e) {
            throw new Exception('Error fetching NAT rule: ' . $e->getMessage());
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
        }catch (Exception $e) {
            throw new Exception('Error fetching NAT rules: ' . $e->getMessage());
        }
    }
}
