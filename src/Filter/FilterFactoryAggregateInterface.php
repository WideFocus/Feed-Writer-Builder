<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Filter;

use WideFocus\Parameters\ParameterBagInterface;

/**
 * Manages filters.
 */
interface FilterFactoryAggregateInterface
{
    /**
     * Create a filter.
     *
     * @param string                $identifier
     * @param ParameterBagInterface $parameters
     *
     * @return callable
     *
     * @throws InvalidFilterException When the filter has not been registered.
     */
    public function create(
        string $identifier,
        ParameterBagInterface $parameters
    ): callable;

    /**
     * Add a factory.
     *
     * @param string                 $identifier
     * @param FilterFactoryInterface $factory
     *
     * @return void
     */
    public function addFactory(
        string $identifier,
        FilterFactoryInterface $factory
    );
}
