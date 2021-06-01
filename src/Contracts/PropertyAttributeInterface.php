<?php

namespace kirillbdev\PhpDataTransfer\Contracts;

interface PropertyAttributeInterface
{
    public function applyTo(object $dto, DataObjectInterface $dataObject, \ReflectionProperty $property);
}