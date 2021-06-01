<?php

namespace kirillbdev\PhpDataTransfer\Tests\Unit;

use kirillbdev\PhpDataTransfer\DataObject\ArrayDataObject;
use kirillbdev\PhpDataTransfer\DtoTransfer;
use kirillbdev\PhpDataTransfer\Tests\Dto\CastingUserDto;
use kirillbdev\PhpDataTransfer\Tests\Dto\ReceiveFromUserDto;
use kirillbdev\PhpDataTransfer\Tests\Dto\SimpleUserDto;
use PHPUnit\Framework\TestCase;

class SimpleTransferTest extends TestCase
{
    public function testWithoutAttributes()
    {
        /** @var SimpleUserDto $dto */
        $dto = DtoTransfer::makeDTO(SimpleUserDto::class, new ArrayDataObject([
            'id' => '10',
            'name' => 'Jonny'
        ]));

        $this->assertEquals('10', $dto->id);
        $this->assertEquals('Jonny', $dto->name);
    }

    public function testWithReceiveFromAttribute()
    {
        /** @var ReceiveFromUserDto $dto */
        $dto = DtoTransfer::makeDTO(ReceiveFromUserDto::class, new ArrayDataObject([
            'id' => '10',
            'user_name' => 'Jonny'
        ]));

        $this->assertEquals('10', $dto->id);
        $this->assertEquals('Jonny', $dto->name);
    }

    public function testWithCastingAttributes()
    {
        /** @var CastingUserDto $dto */
        $dto = DtoTransfer::makeDTO(CastingUserDto::class, new ArrayDataObject([
            'id' => '10',
            'rating' => '4.5',
            'isAdmin' => '1'
        ]));

        $this->assertIsInt($dto->id);
        $this->assertIsFloat($dto->rating);
        $this->assertIsBool($dto->isAdmin);
    }

    public function testCustomTransform()
    {
        /** @var SimpleUserDto $dto */
        $dto = DtoTransfer::makeDTO(SimpleUserDto::class, new ArrayDataObject([
            'id' => '10',
            'name' => 'Jonny',
            'role' => 'manager'
        ]));

        $this->assertEquals('admin', $dto->role);
    }
}