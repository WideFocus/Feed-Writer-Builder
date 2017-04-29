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
class WriterFactoryAggregate implements WriterFactoryAggregateInterface
{
    /**
     * @var WriterFactoryInterface[]
     */
    private $factories = [];

    /**
     * Create a writer.
     *
     * @param string                 $identifier
     * @param ParameterBagInterface  $parameters
     * @param WriterFieldInterface[] ...$fields
     *
     * @return WriterInterface
     *
     * @throws InvalidWriterException When the writer has not been regsitered.
     */
    public function create(
        string $identifier,
        ParameterBagInterface $parameters,
        WriterFieldInterface ...$fields
    ): WriterInterface {
        if (!array_key_exists($identifier, $this->factories)) {
            throw new InvalidWriterException($identifier);
        }

        return $this->factories[$identifier]
            ->create($parameters, ...$fields);
    }

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
    ) {
        $this->factories[$identifier] = $factory;
    }
}
