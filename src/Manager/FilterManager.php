<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Manager;

use WideFocus\Filter\FilterChainInterface;

/**
 * Manages filters.
 */
class FilterManager implements FilterManagerInterface
{
    /**
     * @var callable[]
     */
    private $filters;

    /**
     * Constructor.
     *
     * @param FilterChainInterface $filterChain
     */
    public function __construct(FilterChainInterface $filterChain)
    {
        $this->addFilter($filterChain, self::CHAIN_NAME);
    }

    /**
     * Get a filter.
     *
     * @param string $name
     *
     * @return callable
     *
     * @throws InvalidFilterException When a requested filter does not exist.
     */
    public function getFilter(string $name): callable
    {
        if (!array_key_exists($name, $this->filters)) {
            throw InvalidFilterException::notRegistered($name);
        }
        return clone $this->filters[$name];
    }

    /**
     * Get the a filter chain.
     *
     * @return FilterChainInterface
     */
    public function getFilterChain(): FilterChainInterface
    {
        /** @var FilterChainInterface $filter */
        $filter = $this->getFilter(self::CHAIN_NAME);
        return $filter;
    }

    /**
     * Add a filter.
     *
     * @param callable $filter
     * @param string   $name
     *
     * @return void
     */
    public function addFilter(callable $filter, string $name)
    {
        $this->filters[$name] = $filter;
    }
}