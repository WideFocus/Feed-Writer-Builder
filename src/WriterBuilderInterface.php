<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\WriterInterface;

/**
 * Builds writers for feeds.
 */
interface WriterBuilderInterface
{
    /**
     * Build a writer for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return WriterInterface
     */
    public function buildWriter(FeedInterface $feed): WriterInterface;
}