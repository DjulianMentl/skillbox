<?php

class Building
{
    protected $floors;
    protected $matherial;

    protected function setFloorsNumber($floorsNumber)
    {
        if ($floorsNumber > 20) {
            echo 'Количество этажей не может быть больше 20';
            return;
        }
        $this->floors = $floorsNumber;
    }
}

class House extends Building
{
    private $heatingType;
    private $adress;

    public function __construct($floorsNumber, $matherial)
    {
        $this->matherial = $matherial;
        $this->setFloorsNumber($floorsNumber);
    }

    public function setHouseDescriotion($heatingType, $adress)
    {
        $this->heatingType = $heatingType;
        $this->adress = $adress;
    }
    public function showHouseDescriotion()
    {
        echo $this->matherial . PHP_EOL;
        echo $this->heatingType . PHP_EOL;
        echo $this->adress . PHP_EOL;
    }
}

$house = new House(15, 'кирпич');
$house->setHouseDescriotion('паровое', 'Ставрополь');
$house->showHouseDescriotion();

var_dump($house);