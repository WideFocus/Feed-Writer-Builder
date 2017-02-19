<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedInterface;

/**
 * Builds writer fields for feeds.
 */
interface WriterFieldsBuilderInterface
{
    /**
     * Build writer fields for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return array
     */
    public function buildFields(FeedInterface $feed): array;
}