<?php

namespace kirillbdev\PhpDataTransfer\Contracts;

interface DataObjectInterface
{
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null);
}