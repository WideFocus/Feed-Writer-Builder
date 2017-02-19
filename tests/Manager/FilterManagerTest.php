<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\Manager\FilterManager;
use WideFocus\Feed\Writer\Builder\Manager\InvalidFilterException;
use WideFocus\Filter\ContextAwareFilterInterface;
use WideFocus\Filter\FilterChainInterface;
use WideFocus\Filter\FilterInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\Manager\FilterManager
 */
class FilterManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return FilterManager
     *
     * @covers ::__construct
     */
    public function testConstructor(): FilterManager
    {
        return new FilterManager(
            $this->createMock(FilterChainInterface::class)
        );
    }

    /**
     * @return void
     *
     * @covers ::__construct
     * @covers ::getFilterChain
     */
    public function testGetFilterChain()
    {
        $chain = $this->createMock(FilterChainInterface::class);

        $manager = new FilterManager($chain);
        $this->assertEquals($chain, $manager->getFilterChain());
        $this->assertNotSame($chain, $manager->getFilterChain());
    }

    /**
     * @depends testConstructor
     *
     * @param FilterManager $manager
     *
     * @return void
     *
     * @covers ::addFilter
     * @covers ::getFilter
     */
    public function testAddGetFilter(FilterManager $manager)
    {
        $foo = $this->createMock(FilterInterface::class);
        $bar = $this->createMock(ContextAwareFilterInterface::class);
        $baz = function () {};

        $manager->addFilter($foo, 'foo');
        $manager->addFilter($bar, 'bar');
        $manager->addFilter($baz, 'baz');

        $this->assertEquals($foo, $manager->getFilter('foo'));
        $this->assertNotSame($foo, $manager->getFilter('foo'));
        $this->assertEquals($bar, $manager->getFilter('bar'));
        $this->assertNotSame($bar, $manager->getFilter('bar'));
        $this->assertEquals($baz, $manager->getFilter('baz'));
        $this->assertNotSame($baz, $manager->getFilter('baz'));
    }

    /**
     * @depends testConstructor
     *
     * @param FilterManager $manager
     *
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\Manager\InvalidFilterException
     *
     * @covers ::getFilter
     */
    public function testGetFilterException(FilterManager $manager)
    {
        $manager->getFilter('not_existing');
    }
}
