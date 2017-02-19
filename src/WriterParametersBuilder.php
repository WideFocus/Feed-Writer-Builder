<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\Builder\Manager\WriterParametersManagerInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * Builds writers parameters for feeds.
 */
class WriterParametersBuilder implements WriterParametersBuilderInterface
{
    /**
     * @var WriterParametersManagerInterface
     */
    private $parametersManager;

    /**
     * Constructor.
     *
     * @param WriterParametersManagerInterface $parametersManager
     */
    public function __construct(
        WriterParametersManagerInterface $parametersManager
    ) {
        $this->parametersManager = $parametersManager;
    }

    /**
     * Build a writer parameters object for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return WriterParametersInterface
     */
    public function buildParameters(
        FeedInterface $feed
    ): WriterParametersInterface {
        return $this->parametersManager
            ->createParameters(
                $feed->getWriterType(),
                iterator_to_array($feed->getWriterParameters())
            );
    }
}
