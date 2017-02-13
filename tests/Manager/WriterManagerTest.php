<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\Manager\InvalidWriterException;
use WideFocus\Feed\Writer\Builder\Manager\WriterManager;
use WideFocus\Feed\Writer\WriterFactoryInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\Manager\WriterManager
 */
class WriterManagerTest extends PHPUnit_Framework_TestCase
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

        $manager = new WriterManager();
        $manager->addWriterFactory($factory, 'foo');
        return $manager->createWriter('foo', $parameters);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\Manager\InvalidWriterException
     *
     * @covers ::createWriter
     */
    public function testCreateWriterException()
    {
        $parameters = $this->createMock(WriterParametersInterface::class);

        $manager = new WriterManager();
        $manager->createWriter('not_existing', $parameters);
    }
}
