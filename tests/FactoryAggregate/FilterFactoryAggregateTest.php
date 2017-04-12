<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\FactoryAggregate\FilterFactoryAggregate;
use WideFocus\Filter\ContextAwareFilterInterface;
use WideFocus\Filter\FilterChainInterface;
use WideFocus\Filter\FilterInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\FactoryAggregate\FilterFactoryAggregate
 */
class FilterFactoryAggregateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return FilterFactoryAggregate
     *
     * @covers ::__construct
     */
    public function testConstructor(): FilterFactoryAggregate
    {
        return new FilterFactoryAggregate(
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

        $factoryAggregate = new FilterFactoryAggregate($chain);
        $this->assertEquals($chain, $factoryAggregate->getFilterChain());
        $this->assertNotSame($chain, $factoryAggregate->getFilterChain());
    }

    /**
     * @depends testConstructor
     *
     * @param FilterFactoryAggregate $factoryAggregate
     *
     * @return void
     *
     * @covers ::addFilter
     * @covers ::getFilter
     */
    public function testAddGetFilter(FilterFactoryAggregate $factoryAggregate)
    {
        $foo = $this->createMock(FilterInterface::class);
        $bar = $this->createMock(ContextAwareFilterInterface::class);
        $baz = function () {
        };

        $factoryAggregate->addFilter($foo, 'foo');
        $factoryAggregate->addFilter($bar, 'bar');
        $factoryAggregate->addFilter($baz, 'baz');

        $this->assertEquals($foo, $factoryAggregate->getFilter('foo'));
        $this->assertNotSame($foo, $factoryAggregate->getFilter('foo'));
        $this->assertEquals($bar, $factoryAggregate->getFilter('bar'));
        $this->assertNotSame($bar, $factoryAggregate->getFilter('bar'));
        $this->assertEquals($baz, $factoryAggregate->getFilter('baz'));
        $this->assertNotSame($baz, $factoryAggregate->getFilter('baz'));
    }

    /**
     * @depends testConstructor
     *
     * @param FilterFactoryAggregate $factoryAggregate
     *
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\FactoryAggregate\InvalidFilterException
     *
     * @covers ::getFilter
     */
    public function testGetFilterException(FilterFactoryAggregate $factoryAggregate)
    {
        $factoryAggregate->getFilter('not_existing');
    }
}
