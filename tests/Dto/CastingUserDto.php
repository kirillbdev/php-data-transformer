<?php

namespace kirillbdev\PhpDataTransformer\Tests\Dto;

class CastingUserDto
{
    /**
     * @var int
     * @Cast("int")
     */
    public $id;

    /**
     * @var float
     * @Cast("float")
     */
    public $rating;

    /**
     * @var bool
     * @Cast("bool")
     */
    public $isAdmin;
}