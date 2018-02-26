<?php

/**
 * This file is part of the SContext package.
 *
 * (c) Petr Saganov <saganoff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Context;

/**
 * Concrete implementation of Context Driver that resolves environment variables
 *
 * Resolve data from environment variables via internal function `getenv`
 *
 * @author Petr Saganov <saganoff@gmail.com>
 */
class EnvContext implements ContextDriverInterface
{
    public function get($key, $default = null){
        return (getenv($key) ?: $default);
    }
}
