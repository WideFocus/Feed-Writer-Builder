<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests;

use WideFocus\Feed\Writer\Builder\WriterFactoryAggregate;
use WideFocus\Feed\Writer\Builder\WriterFactoryInterface;
use WideFocus\Feed\Writer\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\WriterFactoryAggregate
 */
class WriterFactoryAggregateTest extends \PHPUnit\Framework\TestCase
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
        $fields     = [
            $this->createMock(WriterFieldInterface::class),
            $this->createMock(WriterFieldInterface::class)
        ];


        $writer  = $this->createMock(WriterInterface::class);
        $factory = $this->createMock(WriterFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('create')
            ->with($parameters, ...$fields)
            ->willReturn($writer);

        $factoryAggregate = new WriterFactoryAggregate();
        $factoryAggregate->addFactory('foo', $factory);
        $this->assertEquals(
            $writer,
            $factoryAggregate->create('foo', $parameters, ...$fields)
        );
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\InvalidWriterException
     *
     * @covers ::create
     */
    public function testCreateException()
    {
        $parameters = $this->createMock(ParameterBagInterface::class);

        $factoryAggregate = new WriterFactoryAggregate();
        $factoryAggregate->create('invalid', $parameters);
    }
}
