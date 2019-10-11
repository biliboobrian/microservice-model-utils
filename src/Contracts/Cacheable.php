<?php
/**
 * @file
 * Contains biliboobrian\MicroServiceModelUtils\Contracts\Cacheable.
 */

namespace biliboobrian\MicroServiceModelUtils\Contracts;

/**
 * A contract to indicate the output of a class is cacheable.
 *
 * @package biliboobrian\MicroServiceModelUtils\Contracts
 */
interface Cacheable
{
    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable();

    /**
     * Get the attributes of this model that can be used as cache keys.
     *
     * @return array
     */
    public function getAttributeCacheKeys();

    /**
     * Get the value of the primary key, used to identify this model.
     *
     * @return mixed
     */
    public function getPrimaryKeyValue();
}