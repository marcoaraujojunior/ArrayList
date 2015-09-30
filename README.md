# ArrayList

`ArrayList` is an implementation of a list, backed by an `array`.

## Creating an ArrayList

```php
$occupants = new ArrayList(['Michael', 'Brittany', 'Wallace', 'Martin']);
echo $occupants; // [Michael, Brittany, Wallace, Martin]
```

## ArrayList Utility Methods

### clear()

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers; // [1, 2, 3, 4]
$numbers->clear();
echo $numbers; // []
```

### isEmpty()

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers->isEmpty() ? 'empty' : 'not empty'; // not empty
```

### size()

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers->size(); // 4
```

## Getting and Setting Indices

### get(int index)

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers->get(3); // 4
```

### set(int index, mixed element)

```php
$numbers = new ArrayList([1, 2, 3, 0]);
$old = $numbers->set(3, 4);
echo $numbers; // [1, 2, 3, 4]
```

## Searching

### contains(mixed element)

```php
$fruits = new ArrayList(['apples', 'oranges', 'bananas']);
var_dump($fruits->contains('apples')); // bool(true)
var_dump($fruits->contains('pears')); // bool(false)
```

### indexOf(mixed element)

```php
$fruits = new ArrayList('apples', 'oranges', 'bananas');
var_dump($fruits->indexOf('apples')); // int(0)
```

### lastIndexOf(mixed element)

```php
$fruits = new ArrayList(['apples', 'oranges', 'bananas', 'apples']);
var_dump($fruits->lastIndexOf('apples')); // int(3)
```

## Adding Elements

### Single Element

Add at end of list:

```php
$food = new ArrayList(['Pizza', 'French Fries', 'Bacon']);
$food->add('Burgers');
echo $food; // [Pizza, French Fries, Bacon, Burgers]
```

Add at specified position in list:

```php
$food = new ArrayList(['Pizza', 'French Fries', 'Bacon']);
$food->addAt(1, 'Tacos');
echo $food; // [Pizza, Tacos, French Fries, Bacon]
```

### Multiple Elements

Add at end of list:

```php
$food = new ArrayList(['Pizza', 'French Fries', 'Bacon']);
$food->addAll(['Burgers', 'Tacos']);
echo $food; // [Pizza, French Fries, Bacon, Burgers, Tacos]
```

Add at specified position in list:

```php
$food = new ArrayList(['Pizza', 'French Fries', 'Bacon']);
$food->addAllAt(1, ['Burgers', 'Tacos']);
echo $food; // [Pizza, Burgers, Tacos, French Fries, Bacon]
```

## Removing Elements

### Single Element

By element:

```php
$food = new ArrayList(['Pizza', 'French Fries', 'Bacon']);
$food->remove('French Fries');
echo $food; // [Pizza, Bacon]
```

By index:

```php
$food = new ArrayList(['Pizza', 'French Fries', 'Bacon']);
$food->removeAt(1);
echo $food; // [Pizza, Bacon]
```

### Multiple Elements

By collection:

```php
$food = new ArrayList(['Pizza', 'Sushi', 'Quiche', 'Bacon']);
$food->removeAll(['Sushi', 'Quiche']);
echo $food; // [Pizza, Bacon]
```

By range:

```php
$food = new ArrayList(['Pizza', 'Sushi', 'Quiche', 'Bacon']);
$food->removeRange(1, 3);
echo $food; // [Pizza, Bacon]
```

## Interfaces

`ArrayList` implements the following interfaces:

- ArrayAccess
- Countable
- IteratorAggregate
- Serializable

### ArrayAccess

#### Get

```php
$letters = new ArrayList(['a', 'b', 'c', 'd']);
echo $letters[0]; // a
```

#### Set

```php
$letters = new ArrayList(['a', 'b', 'c']);
$letters[] = '?';
echo $letters; // [a, b, c, ?]
$letters[3] = 'd';
echo $letters; // [a, b, c, d]
```

#### Isset

```php
$letters = new ArrayList(['a', 'b', 'c', 'd']);
var_dump(isset($letters[0])); // bool(true)
var_dump(isset($letters[4])); // bool(false)
```

#### Unset

```php
$letters = new ArrayList(['a', 'b', 'c', 'd']);
unset($letters[3]);
echo $letters; // [a, b, c]
```

### Countable

```php
$letters = new ArrayList(['a', 'b', 'c', 'd']);
echo count($letters); // 4
```

### IteratorAggregate

```php
$numbers = new ArrayList([1, 2, 3, 4]);
foreach ($numbers as $number) echo $number; // 1234
```

### Serializable

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers; // [1, 2, 3, 4]
$serialized = serialize($numbers);
unset($numbers);
var_dump(isset($numbers)); // bool(false)
$numbers = unserialize($serialized);
echo $numbers; // [1, 2, 3, 4]
```
