<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\Builder\Manager\WriterManagerInterface;
use WideFocus\Feed\Writer\WriterInterface;

/**
 * Builds writers for feeds.
 */
class WriterBuilder implements WriterBuilderInterface
{
    /**
     * @var WriterManagerInterface
     */
    private $writerManager;

    /**
     * @var WriterParametersBuilderInterface
     */
    private $parametersBuilder;

    /**
     * @var WriterFieldsBuilderInterface
     */
    private $fieldsBuilder;

    /**
     * Constructor.
     *
     * @param WriterManagerInterface           $writerManager
     * @param WriterParametersBuilderInterface $parametersBuilder
     * @param WriterFieldsBuilderInterface     $fieldsBuilder
     */
    public function __construct(
        WriterManagerInterface $writerManager,
        WriterParametersBuilderInterface $parametersBuilder,
        WriterFieldsBuilderInterface $fieldsBuilder
    ) {
        $this->writerManager     = $writerManager;
        $this->parametersBuilder = $parametersBuilder;
        $this->fieldsBuilder     = $fieldsBuilder;
    }

    /**
     * Build a writer for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return WriterInterface
     */
    public function buildWriter(FeedInterface $feed): WriterInterface
    {
        $parameters = $this->parametersBuilder
            ->buildParameters($feed);

        $writer = $this->writerManager
            ->createWriter(
                $feed->getWriterType(),
                $parameters
            );

        $writer->setFields(
            $this->fieldsBuilder
                ->buildFields($feed)
        );

        return $writer;
    }
}
