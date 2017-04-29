<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Facade;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\WriterInterface;

/**
 * Builds writers for feeds.
 */
interface WriterFactoryFacadeInterface
{
    /**
     * Build a writer for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return WriterInterface
     */
    public function create(FeedInterface $feed): WriterInterface;
}
