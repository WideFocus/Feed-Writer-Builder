<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\FactoryAggregate;

use WideFocus\Feed\Writer\WriterFactoryInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * Manages writers.
 */
interface WriterFactoryAggregateInterface
{
    /**
     * Create a writer.
     *
     * @param string                    $name
     * @param WriterParametersInterface $parameters
     *
     * @return WriterInterface
     *
     * @throws InvalidWriterException When the requested writer does not have
     * a factory.
     */
    public function createWriter(
        string $name,
        WriterParametersInterface $parameters
    ): WriterInterface;

    /**
     * Add a writer factory.
     *
     * @param WriterFactoryInterface $factory
     * @param string                 $name
     *
     * @return void
     */
    public function addWriterFactory(
        WriterFactoryInterface $factory,
        string $name
    );
}