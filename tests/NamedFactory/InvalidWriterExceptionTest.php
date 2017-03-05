<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\NamedFactory\InvalidWriterException;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\NamedFactory\InvalidWriterException
 */
class InvalidWriterExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @throws InvalidWriterException Always.
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\NamedFactory\InvalidWriterException
     * @expectedExceptionMessage A writer with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidWriterException::notRegistered('foo');
    }
}
