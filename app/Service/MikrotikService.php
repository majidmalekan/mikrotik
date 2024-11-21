<?php

namespace App\Service;

use Exception;
use RouterOS\Client;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;

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
            var_dump($this->client);
            die();
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
     * @param string $username
     * @param string $password
     * @param string $profile
     * @return mixed
     * @throws Exception
     */
    public function addUser(string $username,string $password,string $profile = 'default'): mixed
    {
        try {
            return $this->client->query('/ip/hotspot/user/add', [
                'name' => $username,
                'password' => $password,
                'profile' => $profile, // Optional: Specify a profile for the user
            ])->read();
        } catch (Exception $e) {
            throw new Exception('Error adding user: ' . $e->getMessage());
        }
    }

    /**
     * @param string $username
     * @param string $ipAddress
     * @return mixed
     * @throws Exception
     */
    public function bindIP(string $username,string $ipAddress): mixed
    {
        try {
            return $this->client->query('/ip/hotspot/ip-binding/add', [
                'mac-address' => '',
                'type' => 'bypassed',
                'address' => $ipAddress,
                'comment' => $username,
            ])->read();

        } catch (Exception $e) {
            throw new Exception('Error binding IP: ' . $e->getMessage());
        }
    }

    /**
     * @param $username
     * @return mixed|null
     * @throws Exception
     */
    public function getActiveUserMAC($username): mixed
    {
        try {
            // Query the active Hotspot users
            $response = $this->client->query('/ip/hotspot/active/print', [
                '.proplist' => '.id,mac-address',
                '?user' => $username,
            ])->read();

            if (!empty($response)) {
                return $response[0]['mac-address'] ?? null;
            }

            throw new \Exception('User not found or not active.');
        } catch (\Exception $e) {
            throw new \Exception('Error fetching MAC address: ' . $e->getMessage());
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
            // Query the DHCP lease table for the IP address
            $response = $this->client->query('/ip/dhcp-server/lease/print', [
                '.proplist' => 'mac-address',
                '?address' => $ipAddress,
            ])->read();

            if (!empty($response)) {
                return $response[0]['mac-address'] ?? null;
            }

            throw new \Exception('MAC address not found for this IP.');
        } catch (\Exception $e) {
            throw new \Exception('Error fetching MAC address: ' . $e->getMessage());
        }
    }

    /**
     * @param $username
     * @return int[]
     * @throws Exception
     */
    public function getUserTraffic($username): array
    {
        try {
            // Query active Hotspot users for traffic data
            $response = $this->client->query('/ip/hotspot/active/print', [
                '.proplist' => 'bytes-in,bytes-out',
                '?user' => $username,
            ])->read();

            if (!empty($response)) {
                $data = $response[0];
                return [
                    'bytes_in' => $data['bytes-in'] ?? 0,  // Downloaded bytes
                    'bytes_out' => $data['bytes-out'] ?? 0, // Uploaded bytes
                ];
            }

            throw new \Exception('User not found or not active.');
        } catch (\Exception $e) {
            throw new \Exception('Error fetching traffic data: ' . $e->getMessage());
        }
    }

    /**
     * @param $queueName
     * @return array
     * @throws Exception
     */
    public function getQueueTraffic($queueName): array
    {
        try {
            // Query queue for traffic data
            $response = $this->client->query('/queue/simple/print', [
                '.proplist' => 'bytes',
                '?name' => $queueName,
            ])->read();

            if (!empty($response)) {
                $data = explode(',', $response[0]['bytes']);
                return [
                    'bytes_in' => $data[0] ?? 0,  // Downloaded bytes
                    'bytes_out' => $data[1] ?? 0, // Uploaded bytes
                ];
            }

            throw new \Exception('Queue not found.');
        } catch (\Exception $e) {
            throw new \Exception('Error fetching queue traffic: ' . $e->getMessage());
        }
    }


    /**
     * @param string $interfaceName
     * @return array
     * @throws Exception
     */
    public function getInterfaceTraffic(string $interfaceName): array
    {
        try {
            // Monitor traffic on the interface
            $response = $this->client->query('/interface/monitor-traffic', [
                'interface' => $interfaceName,
                'once' => true,
            ])->read();

            if (!empty($response)) {
                return [
                    'rx_bytes' => $response[0]['rx-byte'] ?? 0, // Received bytes
                    'tx_bytes' => $response[0]['tx-byte'] ?? 0, // Transmitted bytes
                ];
            }

            throw new \Exception('Interface not found.');
        } catch (\Exception $e) {
            throw new \Exception('Error fetching interface traffic: ' . $e->getMessage());
        }
    }

    /**
     * @param string $username
     * @return mixed
     * @throws Exception
     */
    public function findUserByName(string $username): mixed
    {
        try {
            // Query Hotspot user list for the user ID
            $response = $this->client->query('/ip/hotspot/user/print', [
                '.proplist' => '.id',
                '?name' => $username,
            ])->read();

            if (!empty($response)) {
                return $response[0]['.id'];
            }

            throw new \Exception('User not found.');
        } catch (\Exception $e) {
            throw new \Exception('Error finding user by name: ' . $e->getMessage());
        }
    }

    /**
     * @param string $username
     * @return string
     * @throws Exception
     */
    public function blockUserAccess(string $username): string
    {
        try {
            // Find the user's ID
            $userId = $this->findUserByName($username);

            // Disable the user in the MikroTik Hotspot
            $this->client->query('/ip/hotspot/user/disable', [
                '.id' => $userId,
            ])->read();

            return 'User access blocked successfully.';
        } catch (\Exception $e) {
            throw new \Exception('Error blocking user access: ' . $e->getMessage());
        }
    }


}
