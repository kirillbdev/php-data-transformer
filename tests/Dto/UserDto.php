<?php

namespace kirillbdev\PhpDataTransformer\Tests\Dto;

class UserDto
{
    /**
     * @var int
     * @Cast("int")
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var UserRoleDto
     * @Cast(<kirillbdev\PhpDataTransformer\Tests\Dto\UserRoleDto>)
     */
    public $role;
}