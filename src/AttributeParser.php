<?php

namespace kirillbdev\PhpDataTransfer;

use kirillbdev\PhpDataTransfer\Attributes\CastAttribute;
use kirillbdev\PhpDataTransfer\Attributes\ReceiveFromAttribute;
use kirillbdev\PhpDataTransfer\Contracts\PropertyAttributeInterface;

class AttributeParser
{
    /**
     * @param \ReflectionProperty $property
     * @return PropertyAttributeInterface[]
     */
    public function parseAttributes(\ReflectionProperty $property): array
    {
        $docComment = $property->getDocComment();

        if ($docComment === false) {
            return [];
        }

        $attributes = [];

        if (preg_match('/@ReceiveFrom\("([^"]+)"\)/U', $docComment, $matches)) {
            $attributes['receive_from'] = new ReceiveFromAttribute($matches[1]);
        }

        if (preg_match('/@Cast\("([^"]+)"\)/U', $docComment, $matches)) {
            $attributes['cast'] = new CastAttribute($matches[1]);
        }

        return $attributes;
    }
}