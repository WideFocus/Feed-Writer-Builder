<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\Field\FeedFieldFilterInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates parameters for feed field filters.
 */
interface FilterParametersBuilderInterface
{
    /**
     * Create parameters for a feed field filter.
     *
     * @param FeedFieldFilterInterface $feedFieldFilter
     *
     * @return ParameterBagInterface
     */
    public function buildParameters(
        FeedFieldFilterInterface $feedFieldFilter
    ): ParameterBagInterface;
}
