<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Manager;

use WideFocus\Feed\Writer\WriterFactoryInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * Manages writers.
 */
class WriterManager implements WriterManagerInterface
{
    /**
     * @var WriterFactoryInterface[]
     */
    private $factories = [];

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
    ): WriterInterface {
        if (!array_key_exists($name, $this->factories)) {
            throw InvalidWriterException::notRegistered($name);
        }

        return $this->factories[$name]
            ->createWriter($parameters);
    }

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
    ) {
        $this->factories[$name] = $factory;
    }
}
