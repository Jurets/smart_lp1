<?php
/* Обертка для работы с API платежной системы Perfect Money */
class PerfectMoneyApiWrapper extends CApplicationComponent {
    private $inputStructure; // контейнер входных значений
    private $outputStructure; // контейнер выходных значений
    
    public $choise; // выбор интерфейса 
    public $interfaces; //массив url интерфейсов
    
    public function init(){
        parent::init();
    }


    /* Test удалить по завершении */
    public function show(){
        return $this->interfaces;
    }
    
}

