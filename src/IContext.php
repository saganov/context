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

interface IContext
{
    /**
     * Retrieve the context config option calue by specified key
     *
     * @param string $key Key of context option
     *
     * @return void
     */
    public function get($key);
}
