<?php

namespace kirillbdev\PhpDataTransformer\Tests\Dto;

use kirillbdev\PhpDataTransformer\Contracts\DataObjectInterface;

class SimpleUserDto
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * Custom transform
     * @var string
     */
    public $role;

    public function transformRoleProperty(DataObjectInterface $dataObject)
    {
        return 'admin';
    }
}