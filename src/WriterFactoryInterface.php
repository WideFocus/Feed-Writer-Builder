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
 * Creates writers.
 */
interface WriterFactoryInterface
{
    /**
     * Create a writer.
     *
     * @param ParameterBagInterface  $parameters
     * @param WriterFieldInterface[] ...$fields
     *
     * @return WriterInterface
     */
    public function create(
        ParameterBagInterface $parameters,
        WriterFieldInterface ...$fields
    ): WriterInterface;
}
