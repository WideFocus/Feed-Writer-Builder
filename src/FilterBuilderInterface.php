<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\Field\FeedFieldInterface;

/**
 * Builds filters for feed fields.
 */
interface FilterBuilderInterface
{
    /**
     * Build a filter chain for a feed field.
     *
     * @param FeedFieldInterface $feedField
     *
     * @return callable
     */
    public function buildFilter(
        FeedFieldInterface $feedField
    ): callable;
}
