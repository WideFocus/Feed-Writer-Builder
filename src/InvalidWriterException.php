<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use InvalidArgumentException;

/**
 * Exception thrown when a requested writer has not been registered.
 */
class InvalidWriterException extends InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string $operator
     */
    public function __construct(string $operator)
    {
        parent::__construct(
            sprintf(
                'A writer with identifier %s has not been registered',
                $operator
            )
        );
    }
}
