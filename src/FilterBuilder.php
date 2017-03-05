<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\Field\FeedFieldInterface;
use WideFocus\Feed\Writer\Builder\NamedFactory\NamedFilterFactoryInterface;
use WideFocus\Parameters\ParameterSetterInterface;

/**
 * Builds filters for feed fields.
 */
class FilterBuilder implements FilterBuilderInterface
{
    /**
     * @var NamedFilterFactoryInterface
     */
    private $filterFactory;

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
     * @param NamedFilterFactoryInterface      $filterFactory
     * @param ParameterSetterInterface         $parameterSetter
     * @param FilterParametersBuilderInterface $parameterBuilder
     */
    public function __construct(
        NamedFilterFactoryInterface $filterFactory,
        ParameterSetterInterface $parameterSetter,
        FilterParametersBuilderInterface $parameterBuilder
    ) {
        $this->filterFactory    = $filterFactory;
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
        $chain = $this->filterFactory
            ->getFilterChain();

        foreach ($feedField->getFilters() as $feedFieldFilter) {
            $filter = $this->filterFactory
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
