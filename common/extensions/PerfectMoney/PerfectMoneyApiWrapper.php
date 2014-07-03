<?php
/* Обертка для работы с API платежной системы Perfect Money */
class PerfectMoneyApiWrapper extends CComponent/*CApplicationComponent*/ {
    private $inputStructure; // контейнер входных значений
    private $outputStructure; // контейнер выходных значений
    private $eventSuccess; // CEvent для события успешной работы интерфейса
    private $eventFailure; // CEvent для события интерфейса когда что-то пошло не так
    public $trigger; // тест 
    
    public $choise; // выбор интерфейса TEST
    public $interfaces; //массив url интерфейсов
   
    public function init(){
       $this->eventSuccess = new CEvent;
       $this->eventFailure = new CEvent;
       $this->trigger = true;
    }
    /* Проба событий  TEST */
    public function onSuccess($event){ // параметр - СEvent или производный от него (объект)
        $this->raiseEvent('onSuccess', $this->eventSuccess);
    }
    public function onFailure($event){
        $this->raiseEvent('onFailure', $this->eventFailure);
    }
    /* удалить по завершении исследования TEST */
    public function show(){
       
    }
    
}

