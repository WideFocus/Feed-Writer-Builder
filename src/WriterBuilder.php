<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\Builder\FactoryAggregate\WriterFactoryAggregateInterface;
use WideFocus\Feed\Writer\WriterInterface;

/**
 * Builds writers for feeds.
 */
class WriterBuilder implements WriterBuilderInterface
{
    /**
     * @var WriterFactoryAggregateInterface
     */
    private $writerFactory;

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
     * @param WriterFactoryAggregateInterface  $writerFactory
     * @param WriterParametersBuilderInterface $parametersBuilder
     * @param WriterFieldsBuilderInterface     $fieldsBuilder
     */
    public function __construct(
        WriterFactoryAggregateInterface $writerFactory,
        WriterParametersBuilderInterface $parametersBuilder,
        WriterFieldsBuilderInterface $fieldsBuilder
    ) {
        $this->writerFactory     = $writerFactory;
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

        $writer = $this->writerFactory
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
