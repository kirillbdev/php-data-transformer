<?php

namespace kirillbdev\PhpDataTransformer;

use kirillbdev\PhpDataTransformer\Contracts\DataObjectInterface;
use kirillbdev\PhpDataTransformer\Exceptions\TransformException;

final class DataTransformer
{
    public static function transform(string $className, DataObjectInterface $dataObject)
    {
        try {
            $refInstance = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
            throw new TransformException("Class $className not found.");
        }

        $obj = new $className;
        $props = $refInstance->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($props as $prop) {
            // Check if has property transform method
            $transformMethod = 'transform' . self::normalizePropertyName($prop->name) . 'Property';

            if (method_exists($obj, $transformMethod)) {
                $obj->{$prop->name} = call_user_func([ $obj, $transformMethod ], $dataObject);

                continue;
            }

            // Otherwise getting value and apply attributes (if it exists)
            $attributeParser = new AttributeParser();
            $attributes = $attributeParser->parseAttributes($prop);

            // Apply default getting logic if not found receive attribute
            if ( ! isset($attributes['receive_from'])) {
                $obj->{$prop->name} = $dataObject->get($prop->name);
            }

            foreach ($attributes as $attribute) {
                $attribute->applyTo($obj, $dataObject, $prop);
            }
        }

        return $obj;
    }

    private static function normalizePropertyName($name)
    {
        return str_replace([ '_', ' ' ], '', ucwords($name, " _"));
    }
}