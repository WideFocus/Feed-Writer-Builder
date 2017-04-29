<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder;

use WideFocus\Feed\Writer\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * Manages writers.
 */
interface WriterFactoryAggregateInterface
{
    /**
     * Create a writer.
     *
     * @param string                 $identifier
     * @param ParameterBagInterface  $parameters
     * @param WriterFieldInterface[] ...$fields
     *
     * @return WriterInterface
     */
    public function create(
        string $identifier,
        ParameterBagInterface $parameters,
        WriterFieldInterface ...$fields
    ): WriterInterface;

    /**
     * Add a writer factory.
     *
     * @param string                 $identifier
     * @param WriterFactoryInterface $factory
     *
     * @return void
     */
    public function addFactory(
        string $identifier,
        WriterFactoryInterface $factory
    );
}
