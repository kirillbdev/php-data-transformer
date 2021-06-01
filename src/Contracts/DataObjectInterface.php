<?php

namespace kirillbdev\PhpDataTransfer\Contracts;

interface DataObjectInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function getValue(string $key);
}