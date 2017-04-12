<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\FactoryAggregate\InvalidFilterException;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\FactoryAggregate\InvalidFilterException
 */
class InvalidFilterExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @throws InvalidFilterException Always.
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\FactoryAggregate\InvalidFilterException
     * @expectedExceptionMessage A filter with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidFilterException::notRegistered('foo');
    }
}