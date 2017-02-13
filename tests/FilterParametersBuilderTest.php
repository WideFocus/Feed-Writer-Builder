<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Entity\Field\FeedFieldFilterInterface;
use WideFocus\Feed\Entity\Field\FeedFieldFilterParameterInterface;
use WideFocus\Feed\Writer\Builder\FilterParametersBuilder;
use WideFocus\Parameters\ParameterBagFactoryInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\FilterParametersBuilder
 */
class FilterParametersBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return FilterParametersBuilder
     *
     * @covers ::__construct
     */
    public function testConstructor(): FilterParametersBuilder
    {
        return new FilterParametersBuilder(
            $this->createMock(ParameterBagFactoryInterface::class)
        );
    }

    /**
     * @return void
     *
     * @covers ::buildParameters
     */
    public function testBuildParameters()
    {
        $fooParameter = $this->createMock(FeedFieldFilterParameterInterface::class);
        $fooParameter
            ->expects($this->once())
            ->method('getName')
            ->willReturn('foo');

        $fooParameter
            ->expects($this->once())
            ->method('getValue')
            ->willReturn('foo_value');

        $barParameter = $this->createMock(FeedFieldFilterParameterInterface::class);
        $barParameter
            ->expects($this->once())
            ->method('getName')
            ->willReturn('bar');

        $barParameter
            ->expects($this->once())
            ->method('getValue')
            ->willReturn('bar_value');

        $fieldFilter = $this->createMock(FeedFieldFilterInterface::class);
        $fieldFilter
            ->expects($this->once())
            ->method('getParameters')
            ->willReturn([$fooParameter, $barParameter]);

        $parameters = $this->createMock(ParameterBagInterface::class);
        $parameters
            ->expects($this->exactly(2))
            ->method('with')
            ->withConsecutive(
                ['foo', 'foo_value'],
                ['bar', 'bar_value']
            )
            ->willReturn($parameters);

        $parametersFactory = $this->createMock(ParameterBagFactoryInterface::class);
        $parametersFactory
            ->expects($this->once())
            ->method('createBag')
            ->willReturn($parameters);

        $builder = new FilterParametersBuilder($parametersFactory);
        $this->assertSame(
            $parameters,
            $builder->buildParameters($fieldFilter)
        );
    }
}
