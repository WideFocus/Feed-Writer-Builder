<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\Manager\WriterParametersManager;
use WideFocus\Feed\Writer\WriterParametersFactoryInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\Manager\WriterParametersManager
 */
class WriterParametersManagerTest extends PHPUnit_Framework_TestCase
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

        $manager = new WriterParametersManager();
        $manager->addParametersFactory($factory, 'foo');
        return $manager->createParameters('foo', $data);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\Manager\InvalidWriterParametersException
     *
     * @covers ::createParameters
     */
    public function testCreateWriterException()
    {
        $data = ['some_data'];

        $manager = new WriterParametersManager();
        $manager->createParameters('not_existing', $data);
    }
}
