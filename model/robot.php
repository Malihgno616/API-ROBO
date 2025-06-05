<?php

namespace App\Robot;

class Robot {
    private $id;
    private $name;
    private $model;
    private $year;
    private $color;
    private $serialNumber;
    private $isOn;
    private $batteryLevel;

    public function __construct($id,$name, $model, $year, $color, $serialNumber) {
        $this->id = $id;
        $this->name = $name;
        $this->model = $model;
        $this->year = $year;
        $this->color = $color;
        $this->serialNumber = $serialNumber;
        $this->isOn = false;
        $this->batteryLevel = 100; // Assume full battery on creation
    }

    public function turnOn() {
        if (!$this->isOn) {
            $this->isOn = true;
            echo "{$this->name} is now ON.\n";
        } else {
            echo "{$this->name} is already ON.\n";
        }
    }

    public function turnOff() {
        if ($this->isOn) {
            $this->isOn = false;
            echo "{$this->name} is now OFF.\n";
        } else {
            echo "{$this->name} is already OFF.\n";
        }
    }

    public function chargeBattery($amount) {
        if ($amount < 0) {
            echo "Cannot charge with a negative amount.\n";
            return;
        }
        $this->batteryLevel += $amount;
        if ($this->batteryLevel > 100) {
            $this->batteryLevel = 100; // Cap at 100%
        }
        echo "{$this->name} battery charged to {$this->batteryLevel}%.\n";
    }

    public function getStatus() {
        $status = $this->isOn ? "ON" : "OFF";
        echo "Robot Name: {$this->name}\n";
        echo "Model: {$this->model}\n";
        echo "Year: {$this->year}\n";
        echo "Color: {$this->color}\n";
        echo "Serial Number: {$this->serialNumber}\n";
        echo "Status: {$status}\n";
        echo "Battery Level: {$this->batteryLevel}%\n";
    }

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }

    public function getModel() {
        return $this->model;
    }

    public function getYear() {
        return $this->year;
    }

    public function getColor() {
        return $this->color;
    }

    public function getSerialNumber() {
        return $this->serialNumber;
    }

    public function isOn() {
        return $this->isOn;
    }

    public function getBatteryLevel() {
        return $this->batteryLevel;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setSerialNumber($serialNumber) {
        $this->serialNumber = $serialNumber;
    }

    public function setBatteryLevel($batteryLevel) {
        if ($batteryLevel < 0 || $batteryLevel > 100) {
            echo "Battery level must be between 0 and 100.\n";
            return;
        }
        $this->batteryLevel = $batteryLevel;
    }

    public function __toString() {
        return "Robot Name: {$this->name}, Model: {$this->model}, Year: {$this->year}, Color: {$this->color}, Serial Number: {$this->serialNumber}, Status: " . ($this->isOn ? "ON" : "OFF") . ", Battery Level: {$this->batteryLevel}%";
    }

}


    