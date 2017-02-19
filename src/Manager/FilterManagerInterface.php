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
interface FilterManagerInterface
{
    /**
     * Name for the filter chain.
     */
    const CHAIN_NAME = 'chain';

    /**
     * Get a filter.
     *
     * @param string $name
     *
     * @return callable
     *
     * @throws InvalidFilterException When a requested filter does not exist.
     */
    public function getFilter(string $name): callable;

    /**
     * Get the a filter chain.
     *
     * @return FilterChainInterface
     */
    public function getFilterChain(): FilterChainInterface;

    /**
     * Add a filter.
     *
     * @param callable $filter
     * @param string   $name
     *
     * @return void
     */
    public function addFilter(callable $filter, string $name);
}