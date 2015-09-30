# ArrayList

ArrayList is an implementation of a list, backed by an array.

## Usage

### Creating an ArrayList

```php
$food = new ArrayList(['Pizza', 'French Fries', 'Bacon']);
echo $food; // [Pizza, French Fries, Bacon]
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
echo $food; [Pizza, Bacon]
```

By index:

```php
$food = new ArrayList(['Pizza', 'French Fries', 'Bacon']);
$food->removeAt(1);
echo $food; [Pizza, Bacon]
```

#### Multiple Elements

By collection:

```php
$food = new ArrayList(['Pizza', 'Sushi', 'Quiche', 'Bacon']);
$food->removeAll(['Sushi', 'Quiche']);
echo $food; [Pizza, Bacon]
```

By range:

```php
$food = new ArrayList(['Pizza', 'Sushi', 'Quiche', 'Bacon']);
$food->removeRange(1, 3);
echo $food; [Pizza, Bacon]
```
