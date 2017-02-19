<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Builder\Manager;

use WideFocus\Feed\Writer\WriterParametersFactoryInterface;
use WideFocus\Feed\Writer\WriterParametersInterface;

/**
 * Manages writer parameters objects.
 */
interface WriterParametersManagerInterface
{
    /**
     * Create parameters.
     *
     * @param string $name
     * @param array  $data
     *
     * @return WriterParametersInterface
     *
     * @throws InvalidWriterException When the requested parameters object
     * does not have a factory.
     */
    public function createParameters(
        string $name,
        array $data = []
    ): WriterParametersInterface;

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
    );
}