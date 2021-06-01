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

            // Otherwise getting value and apply attributes (if it exists)
            $attributeParser = new AttributeParser();
            $attributes = $attributeParser->parseAttributes($prop);

            // Apply default getting logic if not found receive attribute
            if ( ! isset($attributes['receive_from'])) {
                $dto->{$prop->name} = $dataObject->get($prop->name);
            }

            foreach ($attributes as $attribute) {
                $attribute->applyTo($dto, $dataObject, $prop);
            }
        }

        return $dto;
    }

    private static function normalizePropertyName($name)
    {
        return str_replace([ '_', ' ' ], '', ucwords($name, " _"));
    }
}