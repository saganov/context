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
 * The Object resolves INI-files with sections
 * Nested keys could be retrieved by dot notation
 * E.g.: outer_key.inner_key
 * And there is no caching, so each time the key retrieved the file is re-read
 *
 * @author Petr Saganov <saganoff@gmail.com>
 */
class IniSectionContext implements ContextDriverInterface
{
    private $file;
    public function __construct($file){
        $this->file = $file;
    }

    public function get($key, $default = null){
        $ini = parse_ini_file($file, true);
        return (key_exists($key, $ini) ? $ini[$key] : $this->getNestedKey($key, $ini, $default));
    }
    private function getNestedKey($key, array $data, $default){
        foreach(explode('.', $key) as $k){
            if(!is_array($data) || !key_exists($k, $data)){
                $data = $default;
                break;
            }
            $data = $data[$k];
        }
        return $data;
    }
}
