<?php

require __DIR__ . "/../src/ArrayList.php";

class ArrTest extends PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {

        $arr1 = new ArrayList();

        $this->assertTrue($arr1->isEmpty());
        $this->assertEquals($arr1->size(), 0);
        $this->assertEquals($arr1, '[]');

        $arr2 = new ArrayList([1, 2, 3]);

        $this->assertFalse($arr2->isEmpty());
        $this->assertEquals($arr2->size(), 3);
        $this->assertEquals($arr2, '[1, 2, 3]');

        $arr3 = new ArrayList($arr2);

        $this->assertFalse($arr3->isEmpty());
        $this->assertEquals($arr3->size(), 3);
        $this->assertEquals($arr3, '[1, 2, 3]');

    }

    public function testToString()
    {

        $arr = new ArrayList();

        $this->assertEquals($arr, '[]');

        foreach (range(1, 4) as $n) {
            $arr->add($n);
        }

        $this->assertEquals($arr, '[1, 2, 3, 4]');

    }

    public function testAdd()
    {

        $arr = new ArrayList([1, 2, 3, 4]);

        $this->assertEquals($arr->size(), 4);
        $this->assertEquals($arr, '[1, 2, 3, 4]');

    }

    public function testAddAll()
    {

        $arr = new ArrayList([1, 2, 3, 4]);

        $this->assertEquals($arr->size(), 4);
        $this->assertEquals($arr, '[1, 2, 3, 4]');

        $arr->addAll([5, 6]);
        $arr->addAll(new ArrayList([7, 8]));

        $this->assertEquals($arr->size(), 8);
        $this->assertEquals($arr, '[1, 2, 3, 4, 5, 6, 7, 8]');

    }

    public function testAddAllAt()
    {

        $arr = new ArrayList([1, 6]);

        $this->assertEquals($arr->size(), 2);
        $this->assertEquals($arr, '[1, 6]');

        $arr->addAllAt(1, [2, 5]);

        $this->assertEquals($arr->size(), 4);
        $this->assertEquals($arr, '[1, 2, 5, 6]');

        $arr->addAllAt(2, new ArrayList([3, 4]));

        $this->assertEquals($arr->size(), 6);
        $this->assertEquals($arr, '[1, 2, 3, 4, 5, 6]');

    }

    public function testAddAt()
    {

        $arr = new ArrayList([1, 2, 4]);

        $this->assertEquals($arr, '[1, 2, 4]');
        $this->assertEquals($arr->size(), 3);

        $arr->addAt(2, 3);

        $this->assertEquals($arr, '[1, 2, 3, 4]');
        $this->assertEquals($arr->size(), 4);

        $arr->addAt(4, 5);

        $this->assertEquals($arr, '[1, 2, 3, 4, 5]');
        $this->assertEquals($arr->size(), 5);

    }

    public function testArrayAccess()
    {

        $arr = new ArrayList();

        $arr[] = 1;

        $this->assertEquals($arr, '[1]');
        $this->assertEquals($arr->size(), 1);

        $arr[] = 2;
        $arr[] = 3;
        $arr[] = 4;

        $this->assertEquals($arr, '[1, 2, 3, 4]');
        $this->assertEquals($arr->size(), 4);

        $this->assertTrue(isset($arr[0]));
        $this->assertTrue(isset($arr[1]));
        $this->assertTrue(isset($arr[2]));
        $this->assertTrue(isset($arr[3]));
        $this->assertFalse(isset($arr[4]));

        unset($arr[2]);

        $this->assertEquals($arr, '[1, 2, 4]');
        $this->assertEquals($arr->size(), 3);

        $arr[2] = 3;

        $this->assertEquals($arr, '[1, 2, 3]');
        $this->assertEquals($arr->size(), 3);

    }

    public function testClear()
    {

        $arr = new ArrayList([1, 2, 3, 4]);

        $this->assertFalse($arr->isEmpty());
        $this->assertEquals($arr->size(), 4);

        $arr->clear();

        $this->assertTrue($arr->isEmpty());
        $this->assertEquals($arr->size(), 0);

    }

    public function testContains()
    {

        $arr = new ArrayList();

        $this->assertFalse($arr->contains(0));
        $this->assertFalse($arr->contains(5));

        foreach (range(1, 4) as $n) {
            $arr->add($n);
        }

        foreach (range(1, 4) as $n) {
            $this->assertTrue($arr->contains($n));
        }

    }

    public function testCount()
    {

        $arr = new ArrayList();

        $this->assertEquals(count($arr), 0);

        foreach (range(1, 4) as $n) {
            $arr->add($n);
        }

        $this->assertEquals(count($arr), 4);

    }

    public function testGet()
    {

        $this->setExpectedException('OutOfBoundsException');

        $arr = new ArrayList();

        $arr->get(0);

        foreach (range(1, 4) as $n) {
            $arr->add($n);
        }

        foreach (range(1, 4) as $n) {
            $this->assertEquals($arr->get($n - 1), $n);
        }

    }

    public function testGetIterator()
    {

        $collection = [1, 2, 3, 4];

        $arr = new ArrayList($collection);

        $i = 0;
        foreach ($arr as $item) {
            $this->assertEquals($arr->get($i), $collection[$i]);
            $i++;
        }

    }

    public function testIndexOf()
    {

        $arr = new ArrayList();

        $this->assertEquals($arr->indexOf(1), -1);

        foreach (range(1, 4) as $n) {
            $arr->add($n);
        }

        $this->assertEquals($arr->indexOf(1), 0);

    }

    public function testIsEmpty()
    {

        $arr = new ArrayList();

        $this->assertTrue($arr->isEmpty());

        $arr->add(0, 1);

        $this->assertFalse($arr->isEmpty());

    }

    public function testLastIndexOf()
    {

        $arr = new ArrayList();

        $this->assertEquals($arr->indexOf(1), -1);

        foreach (range(1, 4) as $n) {
            $arr->add($n);
        }

        $arr->add(1);

        $this->assertEquals($arr->lastIndexOf(1), 4);

    }

    public function testRemove()
    {

        $arr = new ArrayList([1, 2, 3, 4, 5]);

        $arr->remove(1);
        $this->assertEquals($arr, '[2, 3, 4, 5]');
        $this->assertEquals($arr->size(), 4);

        $arr->remove(5);
        $this->assertEquals($arr, '[2, 3, 4]');
        $this->assertEquals($arr->size(), 3);

        $arr->remove(3);
        $this->assertEquals($arr, '[2, 4]');
        $this->assertEquals($arr->size(), 2);

    }

    public function testRemoveAll()
    {

        $arr = new ArrayList([1, 2, 3, 3, 4, 5, 6]);

        $this->assertEquals($arr, '[1, 2, 3, 3, 4, 5, 6]');
        $this->assertEquals($arr->size(), 7);

        $arr->removeAll([1, 3, 5]);

        $this->assertEquals($arr, '[2, 4, 6]');
        $this->assertEquals($arr->size(), 3);

    }

    public function testRemoveAt()
    {

        $arr = new ArrayList([1, 2, 3, 4, 5]);

        $arr->removeAt(0);
        $this->assertEquals($arr, '[2, 3, 4, 5]');
        $this->assertEquals($arr->size(), 4);

        $arr->removeAt(3);
        $this->assertEquals($arr, '[2, 3, 4]');
        $this->assertEquals($arr->size(), 3);

        $arr->removeAt(1);
        $this->assertEquals($arr, '[2, 4]');
        $this->assertEquals($arr->size(), 2);

    }

    public function testRemoveRange()
    {

        $arr = new ArrayList(range(1, 10));

        $this->assertEquals($arr, '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10]');

        $arr->removeRange(4, 6);

        $this->assertEquals($arr, '[1, 2, 3, 4, 7, 8, 9, 10]');

        $arr->removeRange(0, 2);

        $this->assertEquals($arr, '[3, 4, 7, 8, 9, 10]');

        $arr->removeRange(4, 6);

        $this->assertEquals($arr, '[3, 4, 7, 8]');

    }

    public function testSerializable()
    {

        $arr = new ArrayList([1, 2, 3, 4]);

        $this->assertFalse($arr->isEmpty());
        $this->assertEquals($arr->size(), 4);
        $this->assertEquals($arr, '[1, 2, 3, 4]');

        $serialized = serialize($arr);

        $arr->clear();

        $this->assertTrue($arr->isEmpty());
        $this->assertEquals($arr->size(), 0);
        $this->assertEquals($arr, '[]');

        $arr = unserialize($serialized);

        $this->assertFalse($arr->isEmpty());
        $this->assertEquals($arr->size(), 4);
        $this->assertEquals($arr, '[1, 2, 3, 4]');

    }

    public function testSet()
    {

        $this->setExpectedException('OutOfBoundsException');

        $arr = new ArrayList();
        $arr->set(0, 1);

        foreach (range(1, 4) as $n) {
            $arr->add($n);
        }

        $this->set(0, -1);
        $this->assertEquals($this->get(0), -1);

        foreach (range(2, 4) as $n) {
            $this->assertEquals($arr->get($n - 1), $n);
        }

    }

    public function testSize()
    {

        $arr = new ArrayList();

        $this->assertEquals($arr->size(), 0);

        foreach (range(1, 4) as $n) {
            $arr->add($n);
        }

        $this->assertEquals($arr->size(), 4);

    }
    
    public function testSublist() {
        
        $arr = new ArrayList([1, 2, 3, 4]);

        $this->assertFalse($arr->isEmpty());
        $this->assertEquals($arr->size(), 4);
        $this->assertEquals($arr, '[1, 2, 3, 4]');
        
        $sublist = $arr->sublist(1, 3);

        $this->assertFalse($sublist->isEmpty());
        $this->assertEquals($sublist->size(), 2);
        $this->assertEquals($sublist, '[2, 3]');
        
    }

    public function testToArray()
    {

        $arr = new ArrayList(range(1, 4));

        $this->assertEquals($arr->toArray(), [1, 2, 3, 4]);

    }

}
