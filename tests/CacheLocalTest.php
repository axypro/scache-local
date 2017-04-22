<?php
/**
 * @package axy\scahce-local
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\scache\local\tests;

use axy\scache\local\CacheLocal;
use PHPUnit\Framework\TestCase;

/**
 * coversDefaultClass \axy\scache\local\CacheLocal
 */
class CacheLocalTest extends TestCase
{
    /**
     * covers ::get
     */
    public function testGet()
    {
        $cache = new CacheLocal(['x' => 1, 'y' => 2, 'n' => null]);
        $this->assertSame(1, $cache->get('x'));
        $this->assertSame(2, $cache->get('y'));
        $this->assertNull($cache->get('z'));
        $this->assertNull($cache->get([1, 2, 3]));
        $this->assertNull($cache->get('n'));
        $this->assertSame(1, $cache->get('x', null, 5));
        $this->assertSame(5, $cache->get('z', null, 5));
        $this->assertNull($cache->get('n', null, 5));
    }

    /**
     * covers ::set
     */
    public function testSet()
    {
        $cache = new CacheLocal();
        $cache->set('x', 5);
        $cache->set([1, 2, 3], 6);
        $this->assertSame(5, $cache->get('x'));
        $this->assertSame(6, $cache->get([1, 2, 3]));
        $this->assertSame(6, $cache->get([1, 2, 3]));
        $cache->set([1, 2, 3], 7);
        $this->assertSame(7, $cache->get([1, 2, 3]));
    }

    /**
     * covers ::delete
     */
    public function testDelete()
    {
        $cache = new CacheLocal(['x' => 1, 'y' => 2]);
        $cache->delete('x');
        $cache->delete('z');
        $this->assertNull($cache->get('x'));
        $this->assertSame(5, $cache->get('x', null, 5));
        $this->assertNull($cache->get('z'));
        $this->assertSame(2, $cache->get('y'));
    }
}
