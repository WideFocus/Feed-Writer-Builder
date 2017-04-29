<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Filter;

use WideFocus\Parameters\ParameterBagInterface;

interface FilterFactoryInterface
{
    /**
     * Create a filter.
     *
     * @param ParameterBagInterface $parameters
     *
     * @return callable
     */
    public function create(
        ParameterBagInterface $parameters
    ): callable;
}
