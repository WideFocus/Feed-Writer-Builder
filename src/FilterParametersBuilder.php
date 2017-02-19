<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Entity\Field\FeedFieldFilterInterface;
use WideFocus\Parameters\ParameterBagFactoryInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates parameters for feed field filters.
 */
class FilterParametersBuilder implements FilterParametersBuilderInterface
{
    /**
     * @var ParameterBagFactoryInterface
     */
    private $parametersFactory;

    /**
     * Constructor.
     *
     * @param ParameterBagFactoryInterface $parametersFactory
     */
    public function __construct(
        ParameterBagFactoryInterface $parametersFactory
    ) {
        $this->parametersFactory = $parametersFactory;
    }

    /**
     * Create parameters for a feed field filter.
     *
     * @param FeedFieldFilterInterface $feedFieldFilter
     *
     * @return ParameterBagInterface
     */
    public function buildParameters(
        FeedFieldFilterInterface $feedFieldFilter
    ): ParameterBagInterface {
        $parameters = $this->parametersFactory
            ->createBag();

        foreach ($feedFieldFilter->getParameters() as $filterParameter) {
            $parameters = $parameters->with(
                $filterParameter->getName(),
                $filterParameter->getValue()
            );
        }
        return $parameters;
    }
}
