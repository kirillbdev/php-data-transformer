<?php

namespace kirillbdev\PhpDataTransfer\Attributes;

use kirillbdev\PhpDataTransfer\Contracts\DataObjectInterface;
use kirillbdev\PhpDataTransfer\Contracts\PropertyAttributeInterface;

class ReceiveFromAttribute implements PropertyAttributeInterface
{
    /**
     * @var string
     */
    private $fromKey;

    public function __construct(string $fromKey)
    {
        $this->fromKey = $fromKey;
    }

    public function applyTo(object $dto, DataObjectInterface $dataObject, \ReflectionProperty $property)
    {
        $dto->{$property->name} = $dataObject->get($this->fromKey);
    }
}