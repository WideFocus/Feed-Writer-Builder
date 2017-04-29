<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Filter;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Writer\Builder\Filter\FilterFactoryAggregate;
use WideFocus\Feed\Writer\Builder\Filter\FilterFactoryInterface;
use WideFocus\Filter\FilterInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\Filter\FilterFactoryAggregate
 */
class FilterFactoryAggregateTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::addFactory
     * @covers ::create
     */
    public function testCreate()
    {
        $parameters = $this->createMock(ParameterBagInterface::class);

        $filter  = $this->createMock(FilterInterface::class);
        $factory = $this->createMock(FilterFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('create')
            ->with($parameters)
            ->willReturn($filter);

        $factoryAggregate = new FilterFactoryAggregate();
        $factoryAggregate->addFactory('foo', $factory);
        $this->assertEquals(
            $filter,
            $factoryAggregate->create('foo', $parameters)
        );
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\Filter\InvalidFilterException
     *
     * @covers ::create
     */
    public function testCreateException()
    {
        $constraints = $this->createMock(ParameterBagInterface::class);

        $factoryAggregate = new FilterFactoryAggregate();
        $factoryAggregate->create('invalid', $constraints);
    }
}
