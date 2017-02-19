<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\Manager\InvalidWriterParametersException;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\Manager\InvalidWriterParametersException
 */
class InvalidWriterParametersExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\Manager\InvalidWriterParametersException
     * @expectedExceptionMessage A writer parameters object with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidWriterParametersException::notRegistered('foo');
    }
}
