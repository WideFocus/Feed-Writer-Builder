<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\Builder\NamedFactory\NamedWriterParametersFactoryInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * Builds writers parameters for feeds.
 */
class WriterParametersBuilder implements WriterParametersBuilderInterface
{
    /**
     * @var NamedWriterParametersFactoryInterface
     */
    private $parametersFactory;

    /**
     * Constructor.
     *
     * @param NamedWriterParametersFactoryInterface $parametersFactory
     */
    public function __construct(
        NamedWriterParametersFactoryInterface $parametersFactory
    ) {
        $this->parametersFactory = $parametersFactory;
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
        return $this->parametersFactory
            ->createParameters(
                $feed->getWriterType(),
                iterator_to_array($feed->getWriterParameters())
            );
    }
}
