# Bitwise Property
Part of [PayBreak/foundation](../)

## Usage

## Initialise

There are two ways to initialise the Bitwise property.

 - Instantiating an object: ``` new Bitwise(); ```
 - Creating the object statically: ``` Bitwise::make(); ```

Both of the above methods can take a parameter. An integer needs to be passed into the above methods to construct a bitwise property.

### Get

The `get()` method is used to return the value which was passed into the object when it was instantiated. If no value was passed in initially, then the default of zero will be returned.

### Contains

The `contains()` method is used to return a boolean of whether a particular is contained in the bitwise property.

### Apply

The `apply()` method is used to overwrite the bitwise property value with another. It does not overwrite the value if it is not bitwise.

### Remove

The `remove()` method is used to overwrite the bitwise property value by removing it with a value passed in. The value will only be removed (deducted) from the initial bitwise value if it is bitwise and if the property `contains` the value.
