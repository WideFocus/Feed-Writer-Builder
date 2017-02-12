<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * Builds writers parameters for feeds.
 */
interface WriterParametersBuilderInterface
{
    /**
     * Build a writer parameters object for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return WriterParametersInterface
     */
    public function buildParameters(
        FeedInterface $feed
    ): WriterParametersInterface;
}