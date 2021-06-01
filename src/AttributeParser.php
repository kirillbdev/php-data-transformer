<?php

namespace kirillbdev\PhpDataTransformer;

use kirillbdev\PhpDataTransformer\Attributes\CastAttribute;
use kirillbdev\PhpDataTransformer\Attributes\ObjectCastAttribute;
use kirillbdev\PhpDataTransformer\Attributes\ReceiveFromAttribute;
use kirillbdev\PhpDataTransformer\Contracts\PropertyAttributeInterface;

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

        // Check if need to cast as other DTO
        if (preg_match('/<([^>]+)>/', $docComment, $dtoMatch)) {
            $attributes['cast'] = new ObjectCastAttribute($dtoMatch[1]);
        }
        elseif (preg_match('/@Cast\("([^"]+)"\)/U', $docComment, $matches)) {
            $attributes['cast'] = new CastAttribute($matches[1]);
        }

        return $attributes;
    }
}