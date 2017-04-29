<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Filter;

use InvalidArgumentException;

/**
 * Exception thrown when a requested filter has not been registered.
 */
class InvalidFilterException extends InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string $identifier
     */
    public function __construct(string $identifier)
    {
        parent::__construct(
            sprintf(
                'A filter with identifier %s has not been registered',
                $identifier
            )
        );
    }
}
