<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Writer\Field\WriterFieldFactoryInterface;

/**
 * Builds writer fields for feeds.
 */
class WriterFieldsBuilder implements WriterFieldsBuilderInterface
{
    /**
     * @var WriterFieldFactoryInterface
     */
    private $fieldFactory;

    /**
     * @var FilterBuilderInterface
     */
    private $filterBuilder;

    /**
     * Constructor.
     *
     * @param WriterFieldFactoryInterface $fieldFactory
     * @param FilterBuilderInterface      $filterBuilder
     */
    public function __construct(
        WriterFieldFactoryInterface $fieldFactory,
        FilterBuilderInterface $filterBuilder
    ) {
        $this->fieldFactory  = $fieldFactory;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * Build writer fields for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return array
     */
    public function buildFields(FeedInterface $feed): array
    {
        $fields = [];
        foreach ($feed->getFields() as $feedField) {
            $fields[] = $this->fieldFactory
                ->createField(
                    $feedField->getCode(),
                    $feedField->getName(),
                    $this->filterBuilder
                        ->buildFilter($feedField)
                );
        }
        return $fields;
    }
}
