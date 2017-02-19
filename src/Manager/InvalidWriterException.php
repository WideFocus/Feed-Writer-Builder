<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Manager;

use InvalidArgumentException;

/**
 * Exception thrown when a requested writer has not been registered.
 */
class InvalidWriterException extends InvalidArgumentException
{
    /**
     * Create an exception for a writer that has not been registered.
     *
     * @param string $name
     *
     * @return InvalidWriterException
     */
    public static function notRegistered(string $name)
    {
        return new static(
            sprintf('A writer with name %s has not been registered', $name)
        );
    }
}
