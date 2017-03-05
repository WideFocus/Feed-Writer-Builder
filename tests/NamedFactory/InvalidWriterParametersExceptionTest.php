<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Builder\NamedFactory\InvalidWriterParametersException;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\NamedFactory\InvalidWriterParametersException
 */
class InvalidWriterParametersExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @throws InvalidWriterParametersException Always.
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\NamedFactory\InvalidWriterParametersException
     * @expectedExceptionMessage A writer parameters object with name foo has not been registered
     *
     * @covers ::notRegistered
     */
    public function testNotRegistered()
    {
        throw InvalidWriterParametersException::notRegistered('foo');
    }
}
