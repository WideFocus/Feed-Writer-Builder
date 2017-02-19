<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Entity\Field\FeedFieldInterface;
use WideFocus\Feed\Writer\Builder\FilterBuilderInterface;
use WideFocus\Feed\Writer\Builder\WriterFieldsBuilder;
use WideFocus\Feed\Writer\Field\WriterFieldFactoryInterface;
use WideFocus\Feed\Writer\Field\WriterFieldInterface;
use WideFocus\Filter\FilterChainInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\WriterFieldsBuilder
 */
class WriterFieldsBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return WriterFieldsBuilder
     *
     * @covers ::__construct
     */
    public function testConstructor(): WriterFieldsBuilder
    {
        return new WriterFieldsBuilder(
            $this->createMock(WriterFieldFactoryInterface::class),
            $this->createMock(FilterBuilderInterface::class)
        );
    }

    /**
     * @return void
     *
     * @covers ::buildFields
     */
    public function testBuildFields()
    {
        $fooFeedField = $this->createMock(FeedFieldInterface::class);
        $fooFeedField
            ->expects($this->once())
            ->method('getName')
            ->willReturn('foo');

        $fooFeedField
            ->expects($this->once())
            ->method('getLabel')
            ->willReturn('foo_label');
        
        $barFeedField = $this->createMock(FeedFieldInterface::class);
        $barFeedField
            ->expects($this->once())
            ->method('getName')
            ->willReturn('bar');

        $barFeedField
            ->expects($this->once())
            ->method('getLabel')
            ->willReturn('bar_label');

        $feed = $this->createMock(FeedInterface::class);
        $feed
            ->expects($this->once())
            ->method('getFields')
            ->willReturn([$fooFeedField, $barFeedField]);
        
        $filter = $this->createMock(FilterChainInterface::class);

        $filterBuilder = $this->createMock(FilterBuilderInterface::class);
        $filterBuilder
            ->expects($this->exactly(2))
            ->method('buildFilter')
            ->withConsecutive([$fooFeedField], [$barFeedField])
            ->willReturn($filter);

        $fooField = $this->createMock(WriterFieldInterface::class);
        $barField = $this->createMock(WriterFieldInterface::class);

        $fieldFactory = $this->createMock(WriterFieldFactoryInterface::class);
        $fieldFactory
            ->expects($this->exactly(2))
            ->method('createField')
            ->willReturnMap([
                ['foo', 'foo_label', $filter, $fooField],
                ['bar', 'bar_label', $filter, $barField]
            ]);

        $builder = new WriterFieldsBuilder($fieldFactory, $filterBuilder);
        $this->assertEquals(
            [$fooField, $barField],
            $builder->buildFields($feed)
        );
    }
}
