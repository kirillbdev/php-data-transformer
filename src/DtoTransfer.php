<?php

namespace kirillbdev\PhpDataTransfer;

use kirillbdev\PhpDataTransfer\Contracts\DataObjectInterface;
use kirillbdev\PhpDataTransfer\Exceptions\TransferException;

final class DtoTransfer
{
    public static function makeDTO(string $dtoClass, DataObjectInterface $dataObject)
    {
        try {
            $refInstance = new \ReflectionClass($dtoClass);
        } catch (\ReflectionException $e) {
            throw new TransferException("Class $dtoClass not found.");
        }


    }
}