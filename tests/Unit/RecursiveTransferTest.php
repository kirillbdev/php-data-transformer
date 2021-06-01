<?php

namespace kirillbdev\PhpDataTransfer\Tests\Unit;

use kirillbdev\PhpDataTransfer\DataObject\ArrayDataObject;
use kirillbdev\PhpDataTransfer\DtoTransfer;
use kirillbdev\PhpDataTransfer\Tests\Dto\UserDto;
use kirillbdev\PhpDataTransfer\Tests\Dto\UserRoleDto;
use PHPUnit\Framework\TestCase;

class RecursiveTransferTest extends TestCase
{
    public function testMakeHierarchyDTO()
    {
        /** @var UserDto $dto */
        $dto = DtoTransfer::makeDTO(UserDto::class, new ArrayDataObject([
            'id' => '10',
            'name' => 'Jonny',
            'role' => [
                'name' => 'admin'
            ]
        ]));

        $this->assertEquals(10, $dto->id);
        $this->assertIsInt($dto->id);
        $this->assertEquals('Jonny', $dto->name);
        $this->assertInstanceOf(UserRoleDto::class, $dto->role);
        $this->assertEquals('admin', $dto->role->name);
    }
}