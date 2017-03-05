<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\NamedFactory\NamedWriterParametersFactory;
use WideFocus\Feed\Writer\WriterParametersFactoryInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\NamedFactory\NamedWriterParametersFactory
 */
class NamedWriterParametersFactoryTest extends PHPUnit_Framework_TestCase
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

        $namedFactory = new NamedWriterParametersFactory();
        $namedFactory->addParametersFactory($factory, 'foo');
        return $namedFactory->createParameters('foo', $data);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\NamedFactory\InvalidWriterParametersException
     *
     * @covers ::createParameters
     */
    public function testCreateWriterException()
    {
        $data = ['some_data'];

        $namedFactory = new NamedWriterParametersFactory();
        $namedFactory->createParameters('not_existing', $data);
    }
}

