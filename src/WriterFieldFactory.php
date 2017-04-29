<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\FeedFieldFilterInterface;
use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Writer\Builder\Filter\FilterFactoryAggregateInterface;
use WideFocus\Feed\Writer\WriterField;
use WideFocus\Feed\Writer\WriterFieldInterface;
use WideFocus\Filter\FilterChain;

/**
 * Creates writer fields.
 */
class WriterFieldFactory implements WriterFieldFactoryInterface
{
    /**
     * @var FilterFactoryAggregateInterface
     */
    private $filterFactory;

    /**
     * Constructor.
     *
     * @param FilterFactoryAggregateInterface $filterFactory
     */
    public function __construct(
        FilterFactoryAggregateInterface $filterFactory
    ) {
        $this->filterFactory = $filterFactory;
    }

    /**
     * Create a writer field.
     *
     * @param FeedFieldInterface $feedField
     *
     * @return WriterFieldInterface
     */
    public function create(
        FeedFieldInterface $feedField
    ): WriterFieldInterface {
        $filters = array_map(
            function (FeedFieldFilterInterface $feedFieldFilter) : callable {
                return $this->filterFactory->create(
                    $feedFieldFilter->getType(),
                    $feedFieldFilter->getParameters()
                );
            },
            $feedField->getFilters()
        );

        return new WriterField(
            $feedField->getName(),
            $feedField->getLabel(),
            new FilterChain(...$filters)
        );
    }
}
