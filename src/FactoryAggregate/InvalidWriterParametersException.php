<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\FactoryAggregate;

use InvalidArgumentException;

/**
 * Exception thrown when a requested parameters object has not been registered.
 */
class InvalidWriterParametersException extends InvalidArgumentException
{
    /**
     * Create an exception for a writer parameters object that has not been
     * registered.
     *
     * @param string $name
     *
     * @return InvalidWriterParametersException
     */
    public static function notRegistered(
        string $name
    ): InvalidWriterParametersException {
        return new static(
            sprintf(
                'A writer parameters object with name %s has not been registered',
                $name
            )
        );
    }
}
