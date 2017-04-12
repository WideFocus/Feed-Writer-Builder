<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\FactoryAggregate\WriterFactoryAggregate;
use WideFocus\Feed\Writer\WriterFactoryInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\FactoryAggregate\WriterFactoryAggregate
 */
class WriterFactoryAggregateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return WriterInterface
     *
     * @covers ::createWriter
     * @covers ::addWriterFactory
     */
    public function testCreateWriter(): WriterInterface
    {
        $writer     = $this->createMock(WriterInterface::class);
        $parameters = $this->createMock(WriterParametersInterface::class);

        $factory = $this->createMock(WriterFactoryInterface::class);
        $factory->expects($this->once())
            ->method('createWriter')
            ->with($parameters)
            ->willReturn($writer);

        $factoryAggregate = new WriterFactoryAggregate();
        $factoryAggregate->addWriterFactory($factory, 'foo');
        return $factoryAggregate->createWriter('foo', $parameters);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\FactoryAggregate\InvalidWriterException
     *
     * @covers ::createWriter
     */
    public function testCreateWriterException()
    {
        $parameters = $this->createMock(WriterParametersInterface::class);

        $factoryAggregate = new WriterFactoryAggregate();
        $factoryAggregate->createWriter('not_existing', $parameters);
    }
}
