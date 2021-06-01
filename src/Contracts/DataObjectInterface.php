<?php

namespace kirillbdev\PhpDataTransformer\Contracts;

interface DataObjectInterface
{
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null);
}