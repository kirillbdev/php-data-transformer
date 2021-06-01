This package helps you to transform custom data into typed objects.

## Installation

### Using composer

`composer require kirillbdev/php-data-transformer ^1.0.0`

## Examples

### 1. Convert array of data to DTO

At first create simple DTO class.

```php
namespace MyApp\Dto;

class UserDto
{
    public $id;
    
    public $firstname;
}
```

Now, using DataTransformer, let's transform an arbitrary data array into our DTO.

```php
namespace MyApp;

use kirillbdev\PhpDataTransformer\DataTransformer;
use kirillbdev\PhpDataTransformer\DataObject\ArrayDataObject;
use MyApp\Dto\UserDto;

$dto = DataTransformer::transform(UserDto::class, new ArrayDataObject([
    'id' => 1,
    'firstname' => 'Jon'
]));
```

Class DtoTransfer will bypass all public properties of our Dto and automatically fetch values from input DataObject (
in our case it is an array). As you see, it's simple.

### 2. Receive custom keys from DataObject

There are situations when the keys of the input data differ from the property names of our DTO. In this case, we can receive data of the desired property using the `@ReceiveFrom` annotation.

```php
namespace MyApp\Dto;

class UserDto
{
    public $id;
    
    /**
     * We need to receive this property from first_name key.
     * @ReceiveFrom("first_name")
     */
    public $firstname;
}
```

Now, try to transform data.

```php
namespace MyApp;

use kirillbdev\PhpDataTransformer\DataTransformer;
use kirillbdev\PhpDataTransformer\DataObject\ArrayDataObject;
use MyApp\Dto\UserDto;

$dto = DataTransformer::transform(UserDto::class, new ArrayDataObject([
    'id' => 1,
    'first_name' => 'Jon' // Custom key that differ of our DTO property.
]));
```

### 3. Type casting

You can specify which type you want to cast for certain properties in DTO. Use the `@Cast("type")` annotation for this. At this moment package support next types: int, float, bool.

```php
namespace MyApp\Dto;

class UserDto
{
    /**
     * We want to cast this property to integer.
     * @Cast("int")
     */
    public $id;
}
```

You also can cast property to other typed object. For this you can use `@Cast(<classname>)` annotation. I recommend you to use full class name for this (includes namespace).

```php
namespace MyApp\Dto;

class UserDto
{
    /**
     * We want to cast this property to UserRoleDto.
     * @Cast(<MyApp\Dto\UserRole>)
     */
    public $role;
}
```

### 4. Custom transformation logic

Sometimes there are situations when you need to implement custom transformation logic of the desired property. In this case, you can implement an arbitrary transformation method for the desired property. The method must be named `transform{PropertyName}Property` and take a single argument `DataObjectInterface`, which is used to retrieve the data.

```php
namespace MyApp\Dto;

use kirillbdev\PhpDataTransformer\Contracts\DataObjectInterface;

class UserDto
{
    public $id;
    
    /**
     * We need to receive this property as combination of two keys (firstname and lastname).
     */
    public $fullName;
    
    /**
     * Let's implement custom transformation method.
     * 
     * @param DataObjectInterface $dataObject
     * @return string|null
     */
    public function transformFullNameProperty(DataObjectInterface $dataObject)
    {
        return $dataObject->get('firstname') . ' ' . $dataObject->get('lastname');
    }
}
```