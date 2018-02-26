<?php

/**
 * This file is part of the Context package.
 *
 * (c) Petr Saganov <saganoff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Context;

/**
 * This is a Scheme of the context configuration
 *
 * In fact this is just container that contains a scheme.
 * In fact it is a map - key to the description of the 
 * configuration options:
 * - default value (NULL means this key is mandatory)
 * - cast function
 *
 * @author Petr Saganov <saganoff@gmail.com>
 */
interface ContextInterface extends ContextDriverInterface
{
    /**
     * The constants to mark a key as a required
     *
     * Use to define a key as a required by set this value
     * as a default key value
     *
     * ```php
     * ContextInterface::add('required_key', ContextInterface::REQUIRED_KEY);
     * ```
     */
    const REQUIRED_KEY = self::class .'\required-key';

    /**
     * Constructor have to consume a Context Driver
     *
     * @param ContextDriverInterface $driver concrete context driver
     *
     * @return ContextInterface
     */
    public function __construct(ContextDriverInterface $driver);

    /**
     * Register new context configuration option
     *
     * @param string            $key           Key of the context option
     * @param mixed             $default       Default value for the key
     * @param \Closure | string $castFunction  Function to cast provided value
     *                                         or string key of predefined cast functions
     *
     * @return ContextInerface
     */
    public function add($key, $default = null, $castFunction = 'string');
}
