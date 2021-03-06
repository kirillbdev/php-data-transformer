<?php

namespace kirillbdev\PhpDataTransformer\Tests\Unit;

use kirillbdev\PhpDataTransformer\DataObject\ArrayDataObject;
use kirillbdev\PhpDataTransformer\DataTransformer;
use kirillbdev\PhpDataTransformer\Tests\Dto\UserDto;
use kirillbdev\PhpDataTransformer\Tests\Dto\UserRoleDto;
use PHPUnit\Framework\TestCase;

class RecursiveTransferTest extends TestCase
{
    public function testMakeHierarchyDTO()
    {
        /** @var UserDto $dto */
        $dto = DataTransformer::transform(UserDto::class, new ArrayDataObject([
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