<?php
/**
 * @package axy\scahce-local
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\scache\local;

use axy\scache\icache\ICache;

/**
 * Local cache object
 */
class CacheLocal implements ICache
{
    /**
     * @param array $data [optional]
     */
    public function __construct(?array $data = null)
    {
        if ($data !== null) {
            foreach ($data as $k => $v) {
                $k = $this->convertKey($k);
                $this->cache[$k] = $v;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, ?int $expire = null): void
    {
        $key = $this->convertKey($key);
        $this->cache[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, ?int $expire = null, $default = null)
    {
        $key = $this->convertKey($key);
        if (!array_key_exists($key, $this->cache)) {
            return $default;
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key): void
    {
        $key = $this->convertKey($key);
        unset($this->cache[$key]);
    }

    /**
     * @param mixed $key
     * @return string
     */
    private function convertKey($key): string
    {
        return serialize($key);
    }

    /**
     * @var array
     */
    private $cache = [];
}
