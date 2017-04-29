<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Filter;

use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates filters by name.
 */
class FilterFactoryAggregate implements FilterFactoryAggregateInterface
{
    /**
     * @var FilterFactoryInterface[]
     */
    private $factories = [];

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
    ): callable {
        if (!array_key_exists($identifier, $this->factories)) {
            throw new InvalidFilterException($identifier);
        }

        return $this->factories[$identifier]
            ->create($parameters);
    }

    /**
     * Add a factory.
     *
     * @param string                 $identifier
     * @param FilterFactoryInterface $factory
     *
     * @return void
     */
    public function addFactory(string $identifier, FilterFactoryInterface $factory)
    {
        $this->factories[$identifier] = $factory;
    }
}
