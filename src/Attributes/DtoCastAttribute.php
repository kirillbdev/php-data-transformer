<?php

namespace kirillbdev\PhpDataTransfer\Attributes;

use kirillbdev\PhpDataTransfer\Contracts\DataObjectInterface;
use kirillbdev\PhpDataTransfer\Contracts\PropertyAttributeInterface;
use kirillbdev\PhpDataTransfer\DataObject\ArrayDataObject;
use kirillbdev\PhpDataTransfer\DtoTransfer;

class DtoCastAttribute implements PropertyAttributeInterface
{
    /**
     * @var string
     */
    private $dtoClass;

    public function __construct(string $dtoClass)
    {
        $this->dtoClass = $dtoClass;
    }

    public function applyTo(object $dto, DataObjectInterface $dataObject, \ReflectionProperty $property)
    {
        $dto->{$property->name} = DtoTransfer::makeDTO(
            $this->dtoClass,
            new ArrayDataObject($dto->{$property->name})
        );
    }
}