<?php

/*
 * This file is part of the SContext package.
 *
 * (c) Petr Saganov <saganoff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Context;

/**
 * Interface for any concrete Context drivers
 *
 * Concrete driver could provide data from different sources:
 * - environment variables
 * - command line interface
 * - ini-files
 * - XML-files
 * - HTTP request parameters
 * etc.
 */
interface IContextDriver
{
    /**
     * Try to resolve value of retrieved context key
     *
     * Resolve the value of key according to the concrete implementation
     * It could resolve from environment variables, command line interface,
     * INI-files, XML-files, HTTP parameters etc.
     *
     * @param string $key     Key of the context configuration option
     * @param mixed  $default Default value to use in case the retrieved key wasn't set
     *
     * @return mixed
     */
    public function resolve($key, $default = null);
}
