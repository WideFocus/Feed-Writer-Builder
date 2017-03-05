<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests;

use ArrayIterator;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Entity\Writer\FeedWriterParametersInterface;
use WideFocus\Feed\Writer\Builder\NamedFactory\NamedWriterParametersFactoryInterface;
use WideFocus\Feed\Writer\Builder\WriterParametersBuilder;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\WriterParametersBuilder
 */
class WriterParametersBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return WriterParametersBuilder
     *
     * @covers ::__construct
     */
    public function testConstructor(): WriterParametersBuilder
    {
        return new WriterParametersBuilder(
            $this->createMock(NamedWriterParametersFactoryInterface::class)
        );
    }

    /**
     * @return void
     */
    public function testBuildParameters()
    {
        $parameters = ['foo' => 'foo_value', 'bar' => 'bar_value'];

        $feedWriterParameters = $this->createMock(FeedWriterParametersInterface::class);
        $feedWriterParameters
            ->expects($this->once())
            ->method('getIterator')
            ->willReturn(new ArrayIterator($parameters));

        $feed = $this->createMock(FeedInterface::class);
        $feed
            ->expects($this->once())
            ->method('getWriterParameters')
            ->willReturn($feedWriterParameters);

        $feed
            ->expects($this->once())
            ->method('getWriterType')
            ->willReturn('foo');

        $writerParameters = $this->createMock(WriterParametersInterface::class);

        $parametersFactory = $this->createMock(NamedWriterParametersFactoryInterface::class);
        $parametersFactory
            ->expects($this->once())
            ->method('createParameters')
            ->with('foo', $parameters)
            ->willReturn($writerParameters);

        $builder = new WriterParametersBuilder($parametersFactory);
        $this->assertEquals($writerParameters, $builder->buildParameters($feed));
    }
}
