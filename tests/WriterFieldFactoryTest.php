<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\Field;

use WideFocus\Feed\Entity\FeedFieldFilterInterface;
use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Writer\Builder\Filter\FilterFactoryAggregateInterface;
use WideFocus\Feed\Writer\Builder\Tests\TestDouble\InvokableDouble;
use WideFocus\Feed\Writer\Builder\WriterFieldFactory;
use WideFocus\Feed\Writer\WriterField;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\WriterFieldFactory
 */
class WriterFieldFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            WriterFieldFactory::class,
            new WriterFieldFactory(
                $this->createMock(FilterFactoryAggregateInterface::class)
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
        $feedFieldFilters = [
            $this->createConfiguredMock(
                FeedFieldFilterInterface::class,
                [
                    'getType' => 'foo',
                    'getParameters' => $this->createMock(ParameterBagInterface::class)
                ]
            ),
            $this->createConfiguredMock(
                FeedFieldFilterInterface::class,
                [
                    'getType' => 'bar',
                    'getParameters' => $this->createMock(ParameterBagInterface::class)
                ]
            )
        ];

        $filters = [
            $this->createMock(InvokableDouble::class),
            $this->createMock(InvokableDouble::class)
        ];

        $filterFactory = $this->createMock(FilterFactoryAggregateInterface::class);
        $filterFactory
            ->expects($this->exactly(count($feedFieldFilters)))
            ->method('create')
            ->willReturnOnConsecutiveCalls(...$filters);

        $feedField = $this->createConfiguredMock(
            FeedFieldInterface::class,
            [
                'getName' => 'foo',
                'getLabel' => 'Foo',
                'getFilters' => $feedFieldFilters
            ]
        );

        $factory = new WriterFieldFactory($filterFactory);
        $this->assertInstanceOf(
            WriterField::class,
            $factory->create($feedField)
        );
    }
}
