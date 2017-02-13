<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\Manager\InvalidFilterException;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\Manager\InvalidFilterException
 */
class InvalidFilterExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\Manager\InvalidFilterException
     * @expectedExceptionMessage A filter with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidFilterException::notRegistered('foo');
    }
}
