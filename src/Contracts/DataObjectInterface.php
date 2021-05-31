<?php

namespace kirillbdev\PhpDto\Contracts;

interface DataObjectInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function getValue(string $key);
}