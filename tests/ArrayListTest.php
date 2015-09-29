<?php

require __DIR__ . "/../src/ArrayList.php";

class ArrTest extends PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {

        $arr = new ArrayList();

        $this->assertTrue($arr->isEmpty());
        $this->assertEquals($arr->size(), 0);
        $this->assertEquals($arr, '[]');

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

    public function testAddAt()
    {

        $arr = new ArrayList([1, 2, 4]);

        $this->assertEquals($arr, '[1, 2, 4]');
        $this->assertEquals($arr->size(), 3);

        $arr->addAt(2, 3);

        $this->assertEquals($arr, '[1, 2, 3, 4]');
        $this->assertEquals($arr->size(), 4);

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

}
