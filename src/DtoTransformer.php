<?php

namespace kirillbdev\PhpDto;

use kirillbdev\PhpDto\Contracts\DataObjectInterface;
use kirillbdev\PhpDto\Exceptions\TransformerException;

final class DtoTransformer
{
    public static function makeDTO(string $dtoClass, DataObjectInterface $dataObject)
    {
        try {
            $refInstance = new \ReflectionClass($dtoClass);
        } catch (\ReflectionException $e) {
            throw new TransformerException("Class $dtoClass not found.");
        }


    }
}