<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\Manager\InvalidWriterException;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\Manager\InvalidWriterException
 */
class InvalidWriterExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\Manager\InvalidWriterException
     * @expectedExceptionMessage A writer with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidWriterException::notRegistered('foo');
    }
}
