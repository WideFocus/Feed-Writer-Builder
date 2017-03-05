<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\NamedFactory\NamedFilterFactory;
use WideFocus\Filter\ContextAwareFilterInterface;
use WideFocus\Filter\FilterChainInterface;
use WideFocus\Filter\FilterInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\NamedFactory\NamedFilterFactory
 */
class NamedFilterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return NamedFilterFactory
     *
     * @covers ::__construct
     */
    public function testConstructor(): NamedFilterFactory
    {
        return new NamedFilterFactory(
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

        $namedFactory = new NamedFilterFactory($chain);
        $this->assertEquals($chain, $namedFactory->getFilterChain());
        $this->assertNotSame($chain, $namedFactory->getFilterChain());
    }

    /**
     * @depends testConstructor
     *
     * @param NamedFilterFactory $namedFactory
     *
     * @return void
     *
     * @covers ::addFilter
     * @covers ::getFilter
     */
    public function testAddGetFilter(NamedFilterFactory $namedFactory)
    {
        $foo = $this->createMock(FilterInterface::class);
        $bar = $this->createMock(ContextAwareFilterInterface::class);
        $baz = function () {
        };

        $namedFactory->addFilter($foo, 'foo');
        $namedFactory->addFilter($bar, 'bar');
        $namedFactory->addFilter($baz, 'baz');

        $this->assertEquals($foo, $namedFactory->getFilter('foo'));
        $this->assertNotSame($foo, $namedFactory->getFilter('foo'));
        $this->assertEquals($bar, $namedFactory->getFilter('bar'));
        $this->assertNotSame($bar, $namedFactory->getFilter('bar'));
        $this->assertEquals($baz, $namedFactory->getFilter('baz'));
        $this->assertNotSame($baz, $namedFactory->getFilter('baz'));
    }

    /**
     * @depends testConstructor
     *
     * @param NamedFilterFactory $namedFactory
     *
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\NamedFactory\InvalidFilterException
     *
     * @covers ::getFilter
     */
    public function testGetFilterException(NamedFilterFactory $namedFactory)
    {
        $namedFactory->getFilter('not_existing');
    }
}
