# Entity
Part of [PayBreak/foundation](../)

Entity is a concept of simple data handling object which is using getters and setters to work with internal properties. Also provides `toArray()` method which returns object properties as an `array`.

### Setters
Methods name are build this way `setPropertyName()`. Camel case property name with prefix *set*.  
**Input** Setters are taking one param which is value of property.  
**Return** Setters must return instance of object itself. So they could be chained.

### Getters
Methods name are build this way `getPropertyName()`. Camel case property name with prefix *get*.  
**Input** Getters are taking no params.  
**Return** Getters are returning value of property or `null` if not set.

### Adders
Methods name are build this way `addPropertyName()`. Camel case property name with prefix *add*.  
**Input** Adders are taking one param which is value of property to be added.   
**Return** Adders must return instance of object itself. So they could be chained.

Adders *have* to be an array of objects

### To Array
`EntityInterface` requires to implement `toArray()` method which will be returning an `array` representation of *entity* properties.

## Abstract Entity

### Types

```
const TYPE_ARRAY = 1;
const TYPE_BOOL = 2;
const TYPE_INT = 4;
const TYPE_STRING = 8;
const TYPE_FLOAT = 16;
# const TYPE_OBJECT = 32;
```

#### Object Type

Property type can be defined as specific `class` and `class[]` as well.

### Implementation

```php
/**
 * Person Entity
 *
 * @method $this setFirstName(string $firstName)
 * @method string getFirstName()
 * @method $this setLastName(string $lastName)
 * @method string getLastName()
 */
class Person extends \PayBreak\Foundation\AbstractEntity
{
    protected $properties = [
        'first_name',
        'last_name' => self::TYPE_STRING,
    ];
}
```

`$properties` array is optional, if it's empty entity will accept any of property names.

### Creating New object

```php
$tester = Person::make(
    [
        'first_name' => 'Jo',
        'last_name'  => 'Doe',
        'age'        => 35,
    ]
);
```

### toString

AbstractEntity has `__toString()` method implemented. It'll return *JSON* string of `toArray()` output.

```php
echo $tester;
// will return: {"first_name":"Jo","last_name":"Doe"}
```

### toJson

AbstractEntity has `toJson` method implemented. This will return a json object of the `toArray()` output.

```php
echo $tester->toJson(1000);
```

```json
{
    "first_name":"Jo",
    "last_name":"Doe"
}
```

### DocBlock Generator

Example:
```sh
php scripts/entityDocGenerator.php  --class="\PayBreak\Foundation\Decision\Risk"
```
