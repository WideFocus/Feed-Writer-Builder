<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Manager;

use InvalidArgumentException;

/**
 * Exception thrown when a requested filter has not been registered.
 */
class InvalidFilterException extends InvalidArgumentException
{
    /**
     * Create an exception for a filter that has not been registered.
     *
     * @param string $name
     *
     * @return InvalidFilterException
     */
    public static function notRegistered(string $name)
    {
        return new static(
            sprintf('A filter with name %s has not been registered', $name)
        );
    }
}
