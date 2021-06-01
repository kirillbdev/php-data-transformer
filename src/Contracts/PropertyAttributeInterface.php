<?php

namespace kirillbdev\PhpDataTransformer\Contracts;

interface PropertyAttributeInterface
{
    public function applyTo(object $obj, DataObjectInterface $dataObject, \ReflectionProperty $property);
}