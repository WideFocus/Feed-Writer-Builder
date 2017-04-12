<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\Builder\FactoryAggregate\WriterFactoryAggregateInterface;
use WideFocus\Feed\Writer\Builder\WriterBuilder;
use WideFocus\Feed\Writer\Builder\WriterFieldsBuilderInterface;
use WideFocus\Feed\Writer\Builder\WriterParametersBuilderInterface;
use WideFocus\Feed\Writer\Field\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\WriterBuilder
 */
class WriterBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return WriterBuilder
     *
     * @covers ::__construct
     */
    public function testConstructor(): WriterBuilder
    {
        return new WriterBuilder(
            $this->createMock(WriterFactoryAggregateInterface::class),
            $this->createMock(WriterParametersBuilderInterface::class),
            $this->createMock(WriterFieldsBuilderInterface::class)
        );
    }

    /**
     * @return void
     *
     * @covers ::buildWriter
     */
    public function testBuildWriter()
    {
        $feed = $this->createMock(FeedInterface::class);
        $feed
            ->expects($this->once())
            ->method('getWriterType')
            ->willReturn('foo');

        $parameters = $this->createMock(WriterParametersInterface::class);

        $parametersBuilder = $this->createMock(WriterParametersBuilderInterface::class);
        $parametersBuilder
            ->expects($this->once())
            ->method('buildParameters')
            ->with($feed)
            ->willReturn($parameters);

        $fields = [$this->createMock(WriterFieldInterface::class)];

        $fieldsBuilder = $this->createMock(WriterFieldsBuilderInterface::class);
        $fieldsBuilder
            ->expects($this->once())
            ->method('buildFields')
            ->with($feed)
            ->willReturn($fields);

        $writer = $this->createMock(WriterInterface::class);
        $writer->expects($this->once())
            ->method('setFields')
            ->with($fields);

        $factory = $this->createMock(WriterFactoryAggregateInterface::class);
        $factory
            ->expects($this->once())
            ->method('createWriter')
            ->with('foo', $parameters)
            ->willReturn($writer);

        $builder = new WriterBuilder(
            $factory,
            $parametersBuilder,
            $fieldsBuilder
        );

        $this->assertSame(
            $writer,
            $builder->buildWriter($feed)
        );
    }
}
