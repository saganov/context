<?php

/*
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
 */
interface IContext
{
    /**
     * Constructor have to consume a Context Driver
     *
     * @param IContextDriver $driver concrete context driver
     *
     * @return IContext
     */
    public function __construct(IContextDriver $driver);

    /**
    * Register new context configuration option
    *
    * @param string $key           Key of the context option
    * @param mixed  $default       Default value for the key. NULL means the key is required
    * @param \Closure $castFunction Function to cast provided value. NULL means cast to String
    *
    * @return IScheme
    */
    public function add($key, $default = null, $castFunction = null);

    /**
     * Try to resolve value of retrieved context key
     *
     * Resolve the value of key according to the concrete context driver
     * It could resolve from environment variables, command line interface,
     * INI-files, XML-files, HTTP parameters etc.
     *
     * @param string $key     Key of the context configuration option
     *
     * @return mixed
     */
    public function get($key);
}
