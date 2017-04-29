<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Writer\WriterFieldInterface;

/**
 * Creates writer fields.
 */
interface WriterFieldFactoryInterface
{
    /**
     * Create a writer field.
     *
     * @param FeedFieldInterface $feedField
     *
     * @return WriterFieldInterface
     */
    public function create(
        FeedFieldInterface $feedField
    ): WriterFieldInterface;
}
