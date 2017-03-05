<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\NamedFactory;

use WideFocus\Feed\Writer\WriterParametersFactoryInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * Manages writer parameters objects.
 */
class NamedWriterParametersFactory implements NamedWriterParametersFactoryInterface
{
    /**
     * @var WriterParametersFactoryInterface[]
     */
    private $factories = [];

    /**
     * Create parameters.
     *
     * @param string $name
     * @param array  $data
     *
     * @return WriterParametersInterface
     *
     * @throws InvalidWriterParametersException When the requested parameters
     * object does not have a factory.
     */
    public function createParameters(
        string $name,
        array $data = []
    ): WriterParametersInterface {
        if (!array_key_exists($name, $this->factories)) {
            throw InvalidWriterParametersException::notRegistered($name);
        }

        return $this->factories[$name]
            ->createParameters($data);
    }

    /**
     * Add a parameters factory.
     *
     * @param WriterParametersFactoryInterface $factory
     * @param string                           $name
     *
     * @return void
     */
    public function addParametersFactory(
        WriterParametersFactoryInterface $factory,
        string $name
    ) {
        $this->factories[$name] = $factory;
    }
}