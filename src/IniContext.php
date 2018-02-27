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
 * Concrete implementation of Context Driver that resolves keys from INI files
 *
 * The Object resolves only INI-files without sections
 * And there is no caching, so each time the key retrieved the file is re-read
 *
 * @author Petr Saganov <saganoff@gmail.com>
 */
class IniContext implements ContextDriverInterface
{
    private $file;
    public function __construct($file){
        $this->file = $file;
    }

    public function get($key, $default = null){
        $ini = parse_ini_file($this->file);
        return (key_exists($key, $ini) ? $ini[$key] : $default);
    }
}
