<?php

namespace kirillbdev\PhpDataTransformer;

use kirillbdev\PhpDataTransformer\Contracts\DataObjectInterface;
use kirillbdev\PhpDataTransformer\DataObject\ArrayDataObject;
use kirillbdev\PhpDataTransformer\DataObject\Laravel\RequestDataObject;

class DataObjectFactory
{
    public const DATA_OBJECT_ARRAY = 'array';
    public const DATA_OBJECT_LARAVEL_REQUEST = 'laravel_request';

    /**
     * @param string $type
     * @param mixed $data
     * @return DataObjectInterface|null
     */
    public static function make(string $type, $data): ?DataObjectInterface
    {
        switch ($type) {
            case self::DATA_OBJECT_ARRAY:
                return new ArrayDataObject($data);
            case self::DATA_OBJECT_LARAVEL_REQUEST:
                return new RequestDataObject($data);
            default:
                throw new \InvalidArgumentException("Invalid data object type '$type'");
        }
    }
}