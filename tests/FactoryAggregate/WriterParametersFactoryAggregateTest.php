<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\FactoryAggregate\WriterParametersFactoryAggregate;
use WideFocus\Feed\Writer\WriterParametersFactoryInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\FactoryAggregate\WriterParametersFactoryAggregate
 */
class WriterParametersFactoryAggregateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return WriterParametersInterface
     *
     * @covers ::createParameters
     * @covers ::addParametersFactory
     */
    public function testCreateParameters(): WriterParametersInterface
    {
        $data       = ['some_data'];
        $parameters = $this->createMock(WriterParametersInterface::class);

        $factory = $this->createMock(WriterParametersFactoryInterface::class);
        $factory->expects($this->once())
            ->method('createParameters')
            ->with($data)
            ->willReturn($parameters);

        $factoryAggregate = new WriterParametersFactoryAggregate();
        $factoryAggregate->addParametersFactory($factory, 'foo');
        return $factoryAggregate->createParameters('foo', $data);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\FactoryAggregate\InvalidWriterParametersException
     *
     * @covers ::createParameters
     */
    public function testCreateWriterException()
    {
        $data = ['some_data'];

        $factoryAggregate = new WriterParametersFactoryAggregate();
        $factoryAggregate->createParameters('not_existing', $data);
    }
}

