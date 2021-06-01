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

        $dto = new $dtoClass;
        $props = $refInstance->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($props as $prop) {
            // Check if has property transform method
            $transformMethod = 'transform' . self::normalizePropertyName($prop->name) . 'Property';

            if (method_exists($dto, $transformMethod)) {
                $dto->{$prop->name} = call_user_func([ $dto, $transformMethod ], $dataObject);

                continue;
            }

            $doc = $prop->getDocComment();

            if ($doc !== false && preg_match('/@ReceiveFrom\("([^"]+)"\)/', $doc, $matches)) {
                $key = $matches[1];
            }
            else {
                $key = $prop->name;
            }

            $dto->{$prop->name} = $dataObject->get($key);

            // Try to cast
            if ($doc !== false && preg_match('/@Cast\("([^"]+)"\)/', $doc, $matches) && $matches[1] === 'int') {
                $dto->{$prop->name} = (int)$dto->{$prop->name};
            }
        }

        return $dto;
    }

    private static function normalizePropertyName($name)
    {
        return str_replace([ '_', ' ' ], '', ucwords($name, " _"));
    }
}