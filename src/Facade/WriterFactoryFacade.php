<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Facade;

use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\Builder\WriterFactoryAggregateInterface;
use WideFocus\Feed\Writer\Builder\WriterFieldFactoryInterface;
use WideFocus\Feed\Writer\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterInterface;

/**
 * Builds writers for feeds.
 */
class WriterFactoryFacade implements WriterFactoryFacadeInterface
{
    /**
     * @var WriterFactoryAggregateInterface
     */
    private $writerFactory;

    /**
     * @var WriterFieldFactoryInterface
     */
    private $fieldFactory;

    /**
     * Constructor.
     *
     * @param WriterFactoryAggregateInterface $writerFactory
     * @param WriterFieldFactoryInterface     $fieldFactory
     */
    public function __construct(
        WriterFactoryAggregateInterface $writerFactory,
        WriterFieldFactoryInterface $fieldFactory
    ) {
        $this->writerFactory = $writerFactory;
        $this->fieldFactory  = $fieldFactory;
    }

    /**
     * Build a writer for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return WriterInterface
     */
    public function create(FeedInterface $feed): WriterInterface
    {
        $fields = array_map(
            function (FeedFieldInterface $feedField) : WriterFieldInterface {
                return $this->fieldFactory->create($feedField);
            },
            $feed->getFields()
        );

        return $this->writerFactory
            ->create(
                $feed->getWriterType(),
                $feed->getWriterParameters(),
                ...$fields
            );
    }
}
