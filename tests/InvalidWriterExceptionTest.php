<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Tests\FactoryAggregate;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Writer\Builder\InvalidWriterException;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Builder\InvalidWriterException
 */
class InvalidWriterExceptionTest extends TestCase
{
    /**
     * @return void
     *
     * @throws InvalidWriterException Always.
     *
     * @expectedException \WideFocus\Feed\Writer\Builder\InvalidWriterException
     * @expectedExceptionMessage A writer with identifier foo has not been registered
     *
     * @covers ::__construct
     */
    public function testNotRegistered()
    {
        throw new InvalidWriterException('foo');
    }
}
