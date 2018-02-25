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
 */
class EnvContext implements ContextDriverInterface
{
    public function get($key, $default = null){
        return ((key_exists($key, $_ENV)) ? $_ENV[$key] : $default);
    }
}
