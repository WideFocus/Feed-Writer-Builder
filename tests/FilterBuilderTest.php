<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Entity\Field\FeedFieldFilterInterface;
use WideFocus\Feed\Entity\Field\FeedFieldInterface;
use WideFocus\Feed\Writer\Builder\FilterBuilder;
use WideFocus\Feed\Writer\Builder\FilterParametersBuilderInterface;
use WideFocus\Feed\Writer\Builder\Manager\FilterManagerInterface;
use WideFocus\Filter\FilterChainInterface;
use WideFocus\Filter\FilterInterface;
use WideFocus\Parameters\ParameterBagInterface;
use WideFocus\Parameters\ParameterSetterInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\FilterBuilder
 */
class FilterBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return FilterBuilder
     *
     * @covers ::__construct
     */
    public function testConstructor(): FilterBuilder
    {
        return new FilterBuilder(
            $this->createMock(FilterManagerInterface::class),
            $this->createMock(ParameterSetterInterface::class),
            $this->createMock(FilterParametersBuilderInterface::class)
        );
    }

    /**
     * @return void
     *
     * @covers ::buildFilter
     */
    public function testBuildFilter()
    {
        $fooFieldFilter = $this->createMock(FeedFieldFilterInterface::class);
        $fooFieldFilter
            ->expects($this->once())
            ->method('getFilterType')
            ->willReturn('foo');

        $barFieldFilter = $this->createMock(FeedFieldFilterInterface::class);
        $barFieldFilter
            ->expects($this->once())
            ->method('getFilterType')
            ->willReturn('bar');

        $feedField = $this->createMock(FeedFieldInterface::class);
        $feedField
            ->expects($this->once())
            ->method('getFilters')
            ->willReturn([$fooFieldFilter, $barFieldFilter]);

        $fooFilter = $this->createMock(FilterInterface::class);
        $barFilter = 'strtoupper';

        $filterChain = $this->createMock(FilterChainInterface::class);
        $filterChain->expects($this->exactly(2))
            ->method('addFilter')
            ->withConsecutive([$fooFilter], [$barFilter]);

        $filterManager = $this->createMock(FilterManagerInterface::class);
        $filterManager
            ->expects($this->exactly(2))
            ->method('getFilter')
            ->willReturnMap([
                ['foo', $fooFilter],
                ['bar', $barFilter]
            ]);

        $filterManager->expects($this->once())
            ->method('getFilterChain')
            ->willReturn($filterChain);


        $fooParameters = $this->createMock(ParameterBagInterface::class);

        $parameterBuilder = $this->createMock(FilterParametersBuilderInterface::class);
        $parameterBuilder
            ->expects($this->once())
            ->method('buildParameters')
            ->with($fooFieldFilter)
            ->willReturn($fooParameters);

        $parameterSetter = $this->createMock(ParameterSetterInterface::class);
        $parameterSetter
            ->expects($this->once())
            ->method('setParameters')
            ->with($fooFilter, $fooParameters);

        $builder = new FilterBuilder(
            $filterManager,
            $parameterSetter,
            $parameterBuilder
        );

        $this->assertSame(
            $filterChain,
            $builder->buildFilter($feedField)
        );
    }
}
