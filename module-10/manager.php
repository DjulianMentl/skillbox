<?php

////пример реализации интерфейса Countable
//class Manager implements Countable
//{
//    private $salles = [];
//
//    public function addSale($goodName)
//    {
//        $this->salles[] = $goodName;
//    }
//    public function count(): int
//    {
//        return count($this->salles);
//    }
//}
//
//$manager = new Manager();
//$manager->addSale('Mac');
//$manager->addSale('Samsung');
//$manager->addSale('Book');
//
//echo $manager->count();
//$manager->addSale('Samsung12');
//echo count($manager);

////пример реализации интерфейса Iterator
//class Manager implements Iterator
//{
//    private $salles = [];
//    private $position = 0;
//
//    public function current(): mixed
//    {
//        return $this->salles[$this->position];
//    }
//    public function key(): mixed
//    {
//        return $this->position;
//    }
//    public function next(): void
//    {
//        ++$this->position;
//    }
//    public function rewind(): void
//    {
//        $this->position = 0;
//    }
//    public function valid(): bool
//    {
//        return isset($this->salles[$this->position]);
//    }
//
//    public function addSale($goodName)
//    {
//        $this->salles[] = $goodName;
//    }
//}
//
//$manager = new Manager();
//$manager->addSale('Mac');
//$manager->addSale('Samsung');
//$manager->addSale('Book');
//$manager->addSale('Samsung12');
//
//
//foreach ($manager as $item) {
//   echo $item . PHP_EOL;
//}

////пример реализации интерфейса Serializable
//class Manager implements Serializable
//{
//    private $salles = [];
//    private $department = 'Отдел продаж';
//    private $name = 'Василий';
//
//    public function serialize()
//    {
//        return serialize($this->salles);
//    }
//
//    public function unserialize($data)
//    {
//        $this->salles = unserialize($data);
//    }
//
//    public function addSale($goodName)
//    {
//        $this->salles[] = $goodName;
//    }
//}
//
//$manager = new Manager();
//$manager->addSale('Mac');
//$manager->addSale('Samsung');
//$manager->addSale('Book');
//$manager->addSale('Samsung12');
//
//echo serialize($manager);

////пример реализации интерфейса Stringable
//class Manager implements Stringable
//{
//    private $salles = [];
//    private $department = 'Отдел продаж';
//    private $name = 'Василий';
//
//    public function __toString(): string
//    {
//        return $this->department . ': ' . $this->name . PHP_EOL;
//    }
//
//    public function addSale($goodName)
//    {
//        $this->salles[] = $goodName;
//    }
//}
//
//$manager = new Manager();
//$manager->addSale('Mac');
//$manager->addSale('Samsung');
//$manager->addSale('Book');
//$manager->addSale('Samsung12');
//
////echo serialize($manager);
//
//echo $manager;

//пример реализации интерфейса ArrayAccess
class Manager implements ArrayAccess
{
    private $salles = [];
    private $department = 'Отдел продаж';
    private $name = 'Василий';

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->salles[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        if (isset($this->salles[$offset])) {
            return $this->salles[$offset];
        }
        return null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->salles[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->salles[$offset]);
    }

    public function addSale($goodName)
    {
        $this->salles[] = $goodName;
    }
}

$manager = new Manager();
$manager->addSale('Mac');
$manager->addSale('Samsung');
$manager->addSale('Book');
$manager->addSale('Samsung12');

//echo serialize($manager);

$manager[4] = 'Машина';
echo $manager[4];