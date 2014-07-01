<?php
/* 
 Класс, релизующий компонент для работы с API платежной
 * системы Perfect Money
 */
class PerfectMoney {
    
    private $outputStructure;
    private $ErrMsg = array(
        0=>"Perfect Money construct param must be an array."
    );
    
    public function __construct($input = NULL) {
        if(is_null($input)){ // инициализация конструктора по умолчанию
           $this->outputStructure = array(); 
        }else if(!is_array($input)){
            throw new Exception($this->ErrMsg[0]);
        }else{
            // TO DO
        }
    }
    public function showTest(){
        return "Test Ok";
    }
}

