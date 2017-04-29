<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Filter;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Writer\Builder\Filter\InvalidFilterException;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\Filter\InvalidFilterException
 */
class InvalidFilterExceptionTest extends TestCase
{
    /**
     * @return void
     *
     * @throws InvalidFilterException Always.
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\Filter\InvalidFilterException
     * @expectedExceptionMessage A filter with identifier foo has not been registered
     *
     * @covers ::__construct
     */
    public function testNotRegistered()
    {
        throw new InvalidFilterException('foo');
    }
}
