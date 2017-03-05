<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\NamedFactory\NamedWriterFactory;
use WideFocus\Feed\Writer\WriterFactoryInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\NamedFactory\NamedWriterFactory
 */
class NamedWriterFactoryTest extends PHPUnit_Framework_TestCase
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

        $namedFactory = new NamedWriterFactory();
        $namedFactory->addWriterFactory($factory, 'foo');
        return $namedFactory->createWriter('foo', $parameters);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\NamedFactory\InvalidWriterException
     *
     * @covers ::createWriter
     */
    public function testCreateWriterException()
    {
        $parameters = $this->createMock(WriterParametersInterface::class);

        $namedFactory = new NamedWriterFactory();
        $namedFactory->createWriter('not_existing', $parameters);
    }
}
