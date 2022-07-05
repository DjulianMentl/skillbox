<?php

class Building
{
    const MAX_FLOORS = 20;
    private $floors;

    public function setFloorsNumber($floorNumber)
    {
        if  ($floorNumber > self::MAX_FLOORS) {
            echo "Превышено максимальное количество этажей" . PHP_EOL;
            return;
        }
        $this->floors = $floorNumber;
    }

    public function showFloorsNumber()
    {
        echo $this->floors . PHP_EOL;
        echo __CLASS__ . PHP_EOL;
        echo __METHOD__ . PHP_EOL;
    }
}

$building = new Building();
$building->setFloorsNumber(39);
$building->setFloorsNumber(19);
$building->showFloorsNumber();

$newBuilding = new Building();
$newBuilding->setFloorsNumber(15);
$newBuilding->showFloorsNumber();

echo Building::class;