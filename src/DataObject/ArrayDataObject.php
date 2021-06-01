<?php

namespace kirillbdev\PhpDataTransformer\DataObject;

use kirillbdev\PhpDataTransformer\Contracts\DataObjectInterface;

class ArrayDataObject implements DataObjectInterface
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }
}