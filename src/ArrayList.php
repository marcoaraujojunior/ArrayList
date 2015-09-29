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
class ArrayList implements ArrayAccess, Countable, IteratorAggregate
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
     * @param mixed $element
     * @return \ArrayList
     */
    public function add($element)
    {

        $this->elements[$this->size++] = $element;

        return $this;

    }

    /**
     * Inserts the specified element at the specified position in this list.
     * 
     * @param int $index
     * @param mixed $element
     * @return \ArrayList
     */
    public function addAt($index, $element)
    {

        array_splice($this->elements, $index, 0, $element);
        $this->size++;

        return $this;

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
     * @param mixed $element
     * @return boolean
     */
    public function contains($element)
    {

        return $this->indexOf($element) >= 0;

    }

    /**
     * Returns the element at the specified position in this list.
     * 
     * @param int $index
     * @return mixed
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
     * @param mixed $element
     * @return int
     */
    public function indexOf($element)
    {

        for ($i = 0; $i < $this->size(); $i++) {
            if ($this->get($i) == $element) {
                return $i;
            }
        }

        return -1;

    }

    /**
     * Returns true if this list contains no elements.
     * 
     * @return boolean
     */
    public function isEmpty()
    {

        return $this->size() === 0;

    }

    /**
     * Returns the index of the last occurrence of the specified element in this 
     * list, or -1 if this list does not contain the element.
     * 
     * @param mixed $element
     * @return int
     */
    public function lastIndexOf($element)
    {

        for ($i = $this->size() - 1; $i >= 0; $i--) {
            if ($this->get($i) == $element) {
                return $i;
            }
        }

        return -1;

    }

    /**
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
     * Removes the first occurrence of the specified element from this list, if 
     * it is present.
     * 
     * @param mixed $element
     * @return boolean
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
     * Removes the element at the specified position in this list.
     * 
     * @param int $index
     */
    public function removeAt($index)
    {

        array_splice($this->elements, $index, 1);
        $this->size--;

    }

    /**
     * Replaces the element at the specified position in this list with the 
     * specified element.
     * 
     * @param int $index
     * @param mixed $element
     * @return mixed
     */
    public function set($index, $element)
    {

        $this->rangeCheck($index);

        $old = $this->get($index);
        $this->elements[$index] = $element;
        return $old;

    }

    /**
     * Returns the number of elements in this list.
     * 
     * @return int
     */
    public function size()
    {

        return $this->size;

    }

    /**
     * Returns an array containing all of the elements in this list.
     * 
     * @return mixed[]
     */
    public function toArray()
    {

        return $this->elements;

    }

    /* ArrayAccess */

    public function offsetExists($offset)
    {

        return array_key_exists($offset, $this->elements);

    }

    public function offsetGet($offset)
    {

        return $this->get($offset);

    }

    public function offsetSet($offset, $value)
    {

        $this->set($offset, $value);

    }

    public function offsetUnset($offset)
    {

        unset($this->elements[$offset]);

    }

    /* Countable */

    public function count()
    {

        return $this->size();

    }

    /* IteratorAggregate */

    public function getIterator()
    {

        return new ArrayIterator($this->elements);

    }

}
