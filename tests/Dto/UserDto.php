<?php

namespace kirillbdev\PhpDataTransfer\Tests\Dto;

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
     * @Cast(DTO<kirillbdev\PhpDataTransfer\Tests\Dto\UserRoleDto>)
     */
    public $role;
}