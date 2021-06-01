<?php

namespace kirillbdev\PhpDataTransfer\Tests\Dto;

class ReceiveFromUserDto
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     * @ReceiveFrom("user_name")
     */
    public $name;
}