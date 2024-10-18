# Stringer (String Helper for PHP)

> An array helper for PHP. It includes some useful methods and possibly other features.

Some of the methods from the Arr class of the Laravel framework are also included in this library;
however, some of them have been modified.

<hr>

## 🫡 Usage

### 🚀 Installation

You can install the package via composer:

```bash
composer require nabeghe/arrayer
```

<hr>

### Str Class

The main class that includes the useful methods is `Nabegh\String\Arr`.

#### Example:

```php
use Nabeghe\Stringer\Arr;

use Nabeghe\Arrayer\Arr;

$data1 = ['key_1' => 'value_1', 'key_3' => ['key_3_1' => 'value_3_1']];

$data2 = ['key_2' => 'value_2'];

$data3 = ['key_3' => ['key_3_2' => 'value_3_2']];

$merged = Arr::merge($data1, $data2, $data3);

print_r($merged);

/*
    Array
    (
        [key_1] => value_1
        [key_3] => Array
            (
                [key_3_1] => value_3_1
                [key_3_2] => value_3_2
            )
    
        [key_2] => value_2
    )
 */
```

<hr>

### Arrayer Class

An array class.

Accepts any value, converts it to an array via `Arr::cast`, stores it, and returns it via `data` property.

It is possible to access the methods of the `Arr` class through the `Arrayer` object as well, with the difference that the main array parameter is no longer present.

Additionally, the `ArrayAccess` and `JsonSerializable` interfaces have also been implemented on `Arrayer` class.

```php
use Nabeghe\Arrayer\Arrayer;

$data1 = ['key_1' => 'value_1', 'key_3' => ['key_3_1' => 'value_3_1']];

$data2 = ['key_2' => 'value_2'];

$data3 = ['key_3' => ['key_3_2' => 'value_3_2']];

$arrayer = new Arrayer();

print_r($arrayer->merge($data1, $data2, $data3)->data);

/*
    Array
    (
        [key_1] => value_1
        [key_3] => Array
            (
                [key_3_1] => value_3_1
                [key_3_2] => value_3_2
            )
    
        [key_2] => value_2
    )
 */
```

<hr>

## 📖 License

Copyright (c) 2024 Hadi Akbarzadeh

Licensed under the MIT license, see [LICENSE.md](LICENSE.md) for details.