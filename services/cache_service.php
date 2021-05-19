<?php

// https://www.tutorialspoint.com/redis/redis_php.htm

class CacheService
{
    public function __construct()
    {
        
    }

    public function setCacheValue(string $key, string $value): bool
    {
        try 
        {
            $cache = $this->connectToCacheService();
            $timeoutSeconds = 300; // 5 min 

            $cache->set($key, $value);
            $cache->expire($key, $timeoutSeconds);
            return true;

        } catch (Exception $e) 
        {
            return false;
        }
    }

    public function getCachedValue(string $key): ?string
    {
        try 
        {
            $cached = $this->connectToCacheService();
            $cachedValue = $cached->get($key);
            if(!$cachedValue)
            {
                return null;
            }
            return $cachedValue;

        } catch (Exception $e) 
        {
            return null;
        }
    }

    private function connectToCacheService(): Redis
    {
        $redis = new Redis();
        $redis->connect('localhost', 6379); // Connects to redis server running in different process
        return $redis;
    }
}