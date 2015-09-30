<?php

/**
 * ArrayList
 *
 * This content is released under the The MIT License (MIT)
 *
 * Copyright (c) 2015 Michael Scribellito
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * ArrayList
 *
 * ArrayList is an implementation of a list, backed by an array.
 *
 * @author Michael Scribellito <mscribellito@gmail.com>
 * @copyright (c) 2015, Michael Scribellito
 * @link https://github.com/mscribellito/String
 */
class ArrayList implements ArrayAccess, Countable, IteratorAggregate, Serializable
{

    /**
     * Elements of the array list
     *
     * @var array 
     */
    protected $elements = [];

    /**
     * Size of the array list
     *
     * @var int 
     */
    protected $size = 0;

    /**
     * Constructs a list containing the elements of the specified collection.
     * 
     * @param array|\ArrayList $collection
     */
    public function __construct($collection = [])
    {

        if (is_array($collection)) {
            $this->elements = $collection;
            $this->size = count($collection);
        } else if ($collection instanceof static) {
            $this->elements = $collection->elements;
            $this->size = $collection->size;
        }

    }

    /**
     * Returns a string representation of this list.
     * 
     * @return string a string representation of this list.
     */
    public function __toString()
    {

        return '[' . implode(', ', $this->elements) . ']';

    }

    /**
     * Appends the specified element to the end of this list.
     * 
     * @param mixed $element element to be appended to this list
     * @return boolean true.
     */
    public function add($element)
    {

        $this->elements[$this->size++] = $element;

        return true;

    }

    /**
     * Appends all of the elements in the specified collection to the end of 
     * this list.
     * 
     * @param array|\ArrayList $collection collection containing elements to be 
     * added to this list
     * @return boolean true if this list changed as a result of the call.
     */
    public function addAll($collection)
    {

        $numAdded = count($collection);

        if ($collection instanceof static) {
            $collection = $collection->toArray();
        }

        array_splice($this->elements, $this->size, $numAdded, $collection);
        $this->size += $numAdded;

        return $numAdded !== 0;

    }

    /**
     * Inserts all of the elements in the specified collection into this list, 
     * starting at the specified position.
     * 
     * @param int $index index at which to insert the first element from the 
     * specified collection
     * @param array|\ArrayList $collection collection containing elements to be 
     * added to this list
     * @return boolean true if this list changed as a result of the call.
     */
    public function addAllAt($index, $collection)
    {

        $this->rangeCheckForAdd($index);

        $numAdded = count($collection);

        if ($collection instanceof static) {
            $collection = $collection->toArray();
        }

        array_splice($this->elements, $index, 0, $collection);
        $this->size += $numAdded;

        return $numAdded !== 0;

    }

    /**
     * Inserts the specified element at the specified position in this list.
     * 
     * @param int $index index at which the specified element is to be inserted
     * @param mixed $element element to be inserted
     */
    public function addAt($index, $element)
    {

        $this->rangeCheckForAdd($index);

        array_splice($this->elements, $index, 0, $element);
        $this->size++;

    }

    /**
     * Removes all of the elements from this list.
     */
    public function clear()
    {

        $this->elements = [];
        $this->size = 0;

    }

    /**
     * Returns true if this list contains the specified element.
     * 
     * @param mixed $element element whose presence in this list is to be tested
     * @return boolean true if this list contains the specified element.
     */
    public function contains($element)
    {

        return $this->indexOf($element) >= 0;

    }

    /**
     * Returns the element at the specified position in this list.
     * 
     * @param int $index index of the element to return
     * @return mixed the element at the specified position in this list.
     */
    public function get($index)
    {

        $this->rangeCheck($index);

        return $this->elements[$index];

    }

    /**
     * Returns the index of the first occurrence of the specified element in 
     * this list, or -1 if this list does not contain the element.
     * 
     * @param mixed $element element to search for
     * @return int the index of the first occurrence of the specified element in 
     * this list, or -1 if this list does not contain the element.
     */
    public function indexOf($element)
    {

        for ($i = 0; $i < $this->size; $i++) {
            if ($this->elements[$i] == $element) {
                return $i;
            }
        }

        return -1;

    }

    /**
     * Returns true if this list contains no elements.
     * 
     * @return boolean true if this list contains no elements.
     */
    public function isEmpty()
    {

        return $this->size === 0;

    }

    /**
     * Returns the index of the last occurrence of the specified element in this 
     * list, or -1 if this list does not contain the element.
     * 
     * @param mixed $element element to search for
     * @return int the index of the last occurrence of the specified element in 
     * this list, or -1 if this list does not contain the element.
     */
    public function lastIndexOf($element)
    {

        for ($i = $this->size - 1; $i >= 0; $i--) {
            if ($this->elements[$i] == $element) {
                return $i;
            }
        }

        return -1;

    }

    /**
     * Checks if the given index is in range. If not, throws an appropriate 
     * runtime exception.
     * 
     * @param int $index
     * @throws OutOfBoundsException
     */
    protected function rangeCheck($index)
    {

        if ($index < 0 || $index >= $this->size) {
            throw new OutOfBoundsException('Index: ' . $index . ', Size: ' . $this->size);
        }

    }

    /**
     * A version of rangeCheck used by addAt and addAll.
     * 
     * @param int $index
     * @throws OutOfBoundsException
     */
    protected function rangeCheckForAdd($index)
    {

        if ($index < 0 || $index > $this->size) {
            throw new OutOfBoundsException('Index: ' . $index . ', Size: ' . $this->size);
        }

    }

    /**
     * Removes the first occurrence of the specified element from this list, if 
     * it is present.
     * 
     * @param mixed $element element to be removed from this list, if present
     * @return boolean true if this list contained the specified element.
     */
    public function remove($element)
    {

        $index = $this->indexOf($element);

        if ($index >= 0) {
            $this->removeAt($index);
            return true;
        }

        return false;

    }

    /**
     * Removes from this list all of its elements that are contained in the 
     * specified collection.
     * 
     * @param array|\ArrayList $collection collection containing elements to be 
     * removed from this list
     * @return boolean true if this list changed as a result of the call.
     */
    public function removeAll($collection)
    {

        if ($collection instanceof static) {
            $collection = $collection->toArray();
        }

        $this->elements = array_diff($this->elements, $collection);
        $this->size = count($this->elements);

        return count($collection) > 0;

    }

    /**
     * Removes the element at the specified position in this list.
     * 
     * @param int $index the index of the element to be removed
     * @return mixed the element that was removed from the list.
     */
    public function removeAt($index)
    {

        $this->rangeCheck($index);

        $old = $this->elements[$index];
        array_splice($this->elements, $index, 1);
        $this->size--;

        return $old;

    }

    /**
     * Removes from this list all of the elements whose index is between 
     * fromIndex, inclusive, and toIndex, exclusive.
     * 
     * @param int $fromIndex index of first element to be removed
     * @param int $toIndex index after last element to be removed
     */
    public function removeRange($fromIndex, $toIndex)
    {

        $numRemoved = $toIndex - $fromIndex;

        array_splice($this->elements, $fromIndex, $numRemoved);
        $this->size -= $numRemoved;

    }

    /**
     * Replaces the element at the specified position in this list with the 
     * specified element.
     * 
     * @param int $index index of the element to replace
     * @param mixed $element element to be stored at the specified position
     * @return mixed the element previously at the specified position.
     */
    public function set($index, $element)
    {

        $this->rangeCheck($index);

        $old = $this->elements[$index];
        $this->elements[$index] = $element;

        return $old;

    }

    /**
     * Returns the number of elements in this list.
     * 
     * @return int the number of elements in this list.
     */
    public function size()
    {

        return $this->size;

    }

    /**
     * Sorts this list according to the order induced by the specified callback.
     * 
     * @param callable $sort the callback used to compare list elements. A null 
     * value indicates that the elements' natural ordering should be used.
     */
    public function sort(callable $comparator = null)
    {

        if ($comparator === null) {
            sort($this->elements);
            return;
        }

        usort($this->elements, $comparator);

    }

    /**
     * Returns a new list between the specified fromIndex, inclusive, and 
     * toIndex, exclusive.
     * 
     * @param int $fromIndex low endpoint (inclusive) of the subList
     * @param int $toIndex high endpoint (exclusive) of the subList
     * @return \ArrayList a new list of the specified range within this list.
     */
    public function sublist($fromIndex, $toIndex)
    {

        return new static(array_slice($this->elements, $fromIndex, $toIndex - 1));

    }

    /**
     * Returns an array containing all of the elements in this list.
     * 
     * @return mixed[] an array containing the elements of the list.
     */
    public function toArray()
    {

        return $this->elements;

    }

    /**
     * Returns true if this index exists.
     * 
     * @param int $index offset to check
     * @return boolean true if this index exists.
     */
    public function offsetExists($index)
    {

        return array_key_exists($index, $this->elements);

    }

    /**
     * Returns the element at the specified position in this list.
     * 
     * @param int $index index of the element to return
     * @return mixed the element at the specified position in this list.
     */
    public function offsetGet($index)
    {

        return $this->get($index);

    }

    /**
     * Replaces the element at the specified position in this list with the 
     * specified element.
     * 
     * @param int $index index of the element to replace
     * @param mixed $element element to be stored at the specified position
     */
    public function offsetSet($index, $element)
    {

        if ($index === null) {
            $this->add($element);
        } else {
            $this->set($index, $element);
        }

    }

    /**
     * Removes the element at the specified position in this list.
     * 
     * @param int $index the index of the element to be removed
     */
    public function offsetUnset($index)
    {

        $this->removeAt($index);

    }

    /**
     * Returns the number of elements in this list.
     * 
     * @return int the number of elements in this list.
     */
    public function count()
    {

        return $this->size();

    }

    /**
     * Returns an iterator over the elements in this list.
     * 
     * @return \ArrayIterator an iterator over the elements in this list.
     */
    public function getIterator()
    {

        return new ArrayIterator($this->elements);

    }

    /**
     * Returns the string representation of this list.
     * 
     * @return string the string representation of this list.
     */
    public function serialize()
    {

        return serialize([
            'elements' => $this->elements,
            'size' => $this->size
        ]);

    }

    /**
     * Called during unserialization of this list.
     * 
     * @param string $serialized the string representation of this list
     */
    public function unserialize($serialized)
    {

        $data = unserialize($serialized);
        $this->elements = $data['elements'];
        $this->size = $data['size'];

    }

}
