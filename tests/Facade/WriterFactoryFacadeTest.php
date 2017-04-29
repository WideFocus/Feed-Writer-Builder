<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Facade;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\Builder\WriterFactoryAggregateInterface;
use WideFocus\Feed\Writer\Builder\Facade\WriterFactoryFacade;
use WideFocus\Feed\Writer\Builder\WriterFieldFactoryInterface;
use WideFocus\Feed\Writer\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\Facade\WriterFactoryFacade
 */
class WriterFactoryFacadeTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            WriterFactoryFacade::class,
            new WriterFactoryFacade(
                $this->createMock(WriterFactoryAggregateInterface::class),
                $this->createMock(WriterFieldFactoryInterface::class)
            )
        );
    }

    /**
     * @return void
     *
     * @covers ::create
     */
    public function testCreate()
    {
        $writerParameters = $this->createMock(ParameterBagInterface::class);
        $feedFields       = [
            $this->createMock(FeedFieldInterface::class),
            $this->createMock(FeedFieldInterface::class)
        ];

        $feed = $this->createConfiguredMock(
            FeedInterface::class,
            [
                'getWriterType'       => 'foo_writer',
                'getWriterParameters' => $writerParameters,
                'getFields'           => $feedFields
            ]
        );

        $writer       = $this->createMock(WriterInterface::class);
        $writerFields = [
            $this->createMock(WriterFieldInterface::class),
            $this->createMock(WriterFieldInterface::class)
        ];

        $fieldFactory = $this->createMock(WriterFieldFactoryInterface::class);
        $fieldFactory
            ->expects($this->exactly(count($feedFields)))
            ->method('create')
            ->withConsecutive(...$feedFields)
            ->willReturnOnConsecutiveCalls(...$writerFields);

        $writerFactory = $this->createMock(WriterFactoryAggregateInterface::class);
        $writerFactory
            ->expects($this->once())
            ->method('create')
            ->with('foo_writer', $writerParameters, ...$writerFields)
            ->willReturn($writer);


        $facade = new WriterFactoryFacade($writerFactory, $fieldFactory);
        $this->assertSame(
            $writer,
            $facade->create($feed)
        );
    }
}
