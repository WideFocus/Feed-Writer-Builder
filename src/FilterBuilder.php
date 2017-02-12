<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\Field\FeedFieldInterface;
use WideFocus\Feed\Writer\Builder\Manager\FilterManagerInterface;
use WideFocus\Parameters\ParameterSetterInterface;

/**
 * Builds filters for feed fields.
 */
class FilterBuilder implements FilterBuilderInterface
{
    /**
     * @var FilterManagerInterface
     */
    private $filterManager;

    /**
     * @var ParameterSetterInterface
     */
    private $parameterSetter;

    /**
     * @var FilterParametersBuilderInterface
     */
    private $parameterBuilder;

    /**
     * Constructor.
     *
     * @param FilterManagerInterface           $filterManager
     * @param ParameterSetterInterface         $parameterSetter
     * @param FilterParametersBuilderInterface $parameterBuilder
     */
    public function __construct(
        FilterManagerInterface $filterManager,
        ParameterSetterInterface $parameterSetter,
        FilterParametersBuilderInterface $parameterBuilder
    ) {
        $this->filterManager    = $filterManager;
        $this->parameterSetter  = $parameterSetter;
        $this->parameterBuilder = $parameterBuilder;
    }

    /**
     * Build a filter chain for a feed field.
     *
     * @param FeedFieldInterface $feedField
     *
     * @return callable
     */
    public function buildFilter(
        FeedFieldInterface $feedField
    ): callable {
        $chain = $this->filterManager
            ->getFilterChain();

        foreach ($feedField->getFilters() as $feedFieldFilter) {
            $filter = $this->filterManager
                ->getFilter($feedFieldFilter->getFilterType());

            if (is_object($filter)) {
                $this->parameterSetter
                    ->setParameters(
                        $filter,
                        $this->parameterBuilder
                            ->buildParameters($feedFieldFilter)
                    );
            }

            $chain->addFilter($filter);
        }

        return $chain;
    }
}
