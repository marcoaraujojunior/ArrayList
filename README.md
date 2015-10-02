# ArrayList

`ArrayList` is an implementation of a list, backed by an `array`.

## Requirements
PHP **5.4** or newer is required.

## License
Released under the [MIT License](https://opensource.org/licenses/MIT). See [LICENSE](LICENSE) for details.

## API

### Constructor Summary

Constructor | Description
------------|------------
__construct() | Constructs an empty list.
__construct(`array` $collection) | Constructs a list containing the elements of the specified collection.
__construct(`ArrayList` $collection) | Constructs a list containing the elements of the specified collection.

### Method Summary

Type | Method | Description
-----|--------|------------
`string` | __toString() | Returns a string representation of this list.
`bool` | add($element) | Appends the specified element to the end of this list.
`bool` | addAll($collection) | Appends all of the elements in the specified collection to the end of this list.
`bool` | addAllAt($index, $collection) | Inserts all of the elements in the specified collection into this list, starting at the specified position.
`bool` | addAt($index, $element) | Inserts the specified element at the specified position in this list.
`void` | clear() | Removes all of the elements from this list.
`bool` | contains($element) | Returns true if this list contains the specified element.
`bool` | equals($collection) | Compares the specified list with this list for equality.
`mixed` | get($index) | Returns the element at the specified position in this list.
`int` | indexOf($element) | Returns the index of the first occurrence of the specified element in this list, or -1 if this list does not contain the element.
`bool` | isEmpty() | Returns true if this list contains no elements.
`int` | lastIndexOf($element) | Returns the index of the last occurrence of the specified element in this list, or -1 if this list does not contain the element.
`bool` | remove($element) | Removes the first occurrence of the specified element from this list, if it is present.
`bool` | removeAll($collection) | Removes from this list all of its elements that are contained in the specified collection.
`mixed` | removeAt($index) | Removes the element at the specified position in this list.
`void` | removeRange($fromIndex, $toIndex) | Removes from this list all of the elements whose index is between fromIndex, inclusive, and toIndex, exclusive.
`mixed` | set($index, $element) | Replaces the element at the specified position in this list with the specified element.
`int` | size() | Returns the number of elements in this list.
`void` | sort($comparator) | Sorts this list according to the order induced by the specified callback.
`ArrayList` | sublist($fromIndex, $toIndex) | Returns a new list between the specified fromIndex, inclusive, and toIndex, exclusive.
`mixed[]` | toArray() | Returns an array containing all of the elements in this list.

#### Methods inherited from `ArrayAccess`

Type | Method | Description
-----|--------|------------
`ArrayIterator` | getIterator() | Returns an iterator over the elements in this list.

#### Methods inherited from `Countable`

Type | Method | Description
-----|--------|------------
`int` | count() | Returns the number of elements in this list.

#### Methods inherited from `IteratorAggregate`

Type | Method | Description
-----|--------|------------
`bool` | offsetExists($index) | Returns true if this index exists.
`mixed` | offsetGet($index) | Returns the element at the specified position in this list.
`void` | offsetSet($index, $element) | Replaces the element at the specified position in this list with the specified element.
`void` | offsetUnset($index) | Removes the element at the specified position in this list.

#### Methods inherited from `Serializable`

Type | Method | Description
-----|--------|------------
`string` | serialize() | Returns the string representation of this list.
`void` | unserialize($serialized) | Called during unserialization of this list.

## Usage

### Creating an ArrayList

Create an empty instance:

```php
$empty = new ArrayList();
echo $empty; // []
```

Create an instance and initialize it with an `array`:

```php
$occupants = new ArrayList(['Michael', 'Brittany', 'Wallace', 'Martin']);
echo $occupants; // [Michael, Brittany, Wallace, Martin]
```

Create an instance and initialize it with an `ArrayList`:

```php
$empty = new ArrayList();
$alsoEmpty = new ArrayList($empty);
echo $alsoEmpty; // []
```

### ArrayList Utility Methods

#### clear

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers; // [1, 2, 3, 4]
$numbers->clear();
echo $numbers; // []
```

#### isEmpty

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers->isEmpty() ? 'empty' : 'not empty'; // not empty
```

#### size

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers->size(); // 4
```

### Getting and Setting Indices

#### get

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers->get(3); // 4
```

#### set

```php
$numbers = new ArrayList([1, 2, 3, 0]);
$old = $numbers->set(3, 4);
echo $numbers; // [1, 2, 3, 4]
```

### Sublist

Get a sublist from another list.

```php
$cars = new ArrayList(['Mustang', 'Prius', 'PT Cruiser', 'Jeep']);
$lameCars = $cars->sublist(1, 3);
echo $lameCars; // [Prius, PT Cruiser]
```

### Sorting

sort accepts a comparator function (callback).

Sort lowest to highest:

```php
$letters = new ArrayList(['b', 'c', 'd', 'a']);
echo $letters; // [b, c, d, a]
$letters->sort(function ($a, $b) {
	return $a == $b ? 0 : $a < $b ? -1 : 1;
});
echo $letters; // [a, b, c, d]
```

Sort highest to lowest:

```php
$numbers = new ArrayList([2, 3, 4, 1]);
echo $numbers; // [2, 3, 4, 1]
$numbers->sort(function ($a, $b) {
	return $a == $b ? 0 : $a < $b ? 1 : -1;
});
echo $numbers; // [4, 3, 2, 1]
```

### Searching

#### contains

```php
$fruits = new ArrayList(['apples', 'oranges', 'bananas']);
var_dump($fruits->contains('apples')); // bool(true)
var_dump($fruits->contains('pears')); // bool(false)
```

#### indexOf

```php
$fruits = new ArrayList(['apples', 'oranges', 'bananas']);
var_dump($fruits->indexOf('apples')); // int(0)
```

#### lastIndexOf

```php
$fruits = new ArrayList(['apples', 'oranges', 'bananas', 'apples']);
var_dump($fruits->lastIndexOf('apples')); // int(3)
```

### Adding Elements

#### Single Element

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

#### Multiple Elements

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

### Removing Elements

#### Single Element

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

#### Multiple Elements

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

### Interfaces

`ArrayList` implements the following interfaces:

- `ArrayAccess`
- `Countable`
- `IteratorAggregate`
- `Serializable`

#### ArrayAccess

##### get

```php
$letters = new ArrayList(['a', 'b', 'c', 'd']);
echo $letters[0]; // a
```

##### set

```php
$letters = new ArrayList(['a', 'b', 'c']);
$letters[] = '?';
echo $letters; // [a, b, c, ?]
$letters[3] = 'd';
echo $letters; // [a, b, c, d]
```

##### isset

```php
$letters = new ArrayList(['a', 'b', 'c', 'd']);
var_dump(isset($letters[0])); // bool(true)
var_dump(isset($letters[4])); // bool(false)
```

##### unset

```php
$letters = new ArrayList(['a', 'b', 'c', 'd']);
unset($letters[3]);
echo $letters; // [a, b, c]
```

#### Countable

```php
$letters = new ArrayList(['a', 'b', 'c', 'd']);
echo count($letters); // 4
```

#### IteratorAggregate

```php
$numbers = new ArrayList([1, 2, 3, 4]);
foreach ($numbers as $number) echo $number; // 1234
```

#### Serializable

##### serialize and unserialize

```php
$numbers = new ArrayList([1, 2, 3, 4]);
echo $numbers; // [1, 2, 3, 4]
$serialized = serialize($numbers);
unset($numbers);
var_dump(isset($numbers)); // bool(false)
$numbers = unserialize($serialized);
echo $numbers; // [1, 2, 3, 4]
```
