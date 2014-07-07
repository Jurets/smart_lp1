<?php
/* Обертка для работы с API платежной системы Perfect Money */
class PerfectMoneyApiWrapper extends CComponent/*CApplicationComponent*/ {
    private $inputStructure; // контейнер входных значений
    private $outputStructure; // контейнер выходных значений
    private $eventSuccess; // CEvent для события успешной работы интерфейса
    private $eventFailure; // CEvent для события интерфейса когда что-то пошло не так
    
    public $interfaces;
    public $choise; // выбор интерфейса платежной системы из готового списка по его ключу (конфигурируется в main.php)  
   
    public function init(){
       $this->eventSuccess = new CEvent;
       $this->eventSuccess->sender = $this;
       $this->eventFailure = new CEvent;
       $this->eventFailure->sender = $this;
       $this->inputStructure = array();
       $this->outputStructure = array();
    }
    /* События для успешной и неуспешной денежной транзакции */
    public function onSuccess($event){ // параметр - СEvent или производный от него (объект)
        $this->raiseEvent('onSuccess', $this->eventSuccess);
    }
    public function onFailure($event){
        $this->raiseEvent('onFailure', $this->eventFailure);
    }
    public function onEmergency($event){
        $this->raiseEvent('onEmergency', $this->eventEmergency);
    }
    public function dataFlush(){ // установка компонента в исходное состояние
        $this->init();
    }
    public function dataLoad($input=array()){ // загрузка исходных данных (должен быть массив для передачи на api постом)
        if(!is_array($input) || empty($input)){
            throw new Exception("PerfectMoney(...) API -in data must be an array and not empty");
        }else{
            $this->inputStructure = $input;
        }
    }
    public function dataProcess(){ // проведение процесса передачи данных на api и получение ответных даннных
        $this->API_make();
        $this->API_analyse();
        //$this->API_analyse_test();
    }

    public function dataOut($param=NULL){ // выгрузка массива ответа api либо конкретно указанного значения
        return (is_null($param)) ? $this->outputStructure : $this->outputStructure[$param];
    }
    
    /* ключевой элемент компонента: осуществляет взаимодействие с api Perfect Money */
    protected function API_make(){
        $curlHandle = curl_init();
        if (!isset($this->interfaces[$this->choise])){
            throw new Exception('Perfect Money(...) Parameter choise not exists');
        }
	curl_setopt($curlHandle, CURLOPT_URL, $this->interfaces[$this->choise]); // задаем url
	curl_setopt($curlHandle, CURLOPT_HEADER, 0); // "прячем" заголовки
	curl_setopt($curlHandle, CURLOPT_POST, 1); // настраиваем метод передачи данных (POST)
	curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $this->inputStructure); // определяем данные для передачи POST-ом на сервер
	curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1); // настраиваем вывод ответа сервера не в браузер а в переменную
	$apiAnswer =  curl_exec($curlHandle); // выполнение запроса и сохранение ответа в переменную (в случае неуспеха сохранится FALSE и тогда завершить функцию и выбросить какой-нибудь exception)
	curl_close($curlHandle);
	
	/* Парсим ответ сервера и получаем нужную структуру данных */
	$domStructure = new DOMDocument();
	$domStructure->loadHTML($apiAnswer);
	$nodes = $domStructure->getElementsByTagName('input');
	foreach($nodes as $node){
		$this->outputStructure[$node->getAttribute('name')] = $node->getAttribute('value');
        }
        if(empty($this->outputStructure)){
            $this->outputStructure['ERROR'] = 'Perfect Money servise not available';
        }
    }
    /* Выбор и генерация нужного события */
    protected function API_analyse(){  
        if(isset($this->outputStructure['ERROR'])){ // Стандарт API PM по возврату ошибок (кодов нету длинный шмель, хоть в кибитку не ходи)
           $this->onFailure($this->eventFailure); // генерация события безуспешной работы api
        }else{
            $this->onSuccess($this->eventSuccess); // генерация события, когда api отработал успешно
        }
    }
    protected function API_analyse_test(){
        /* тестовый метод принудительная генерация событий.
         * Удалить после финального тестирования.
         * Точка запуска метода: в теле метода dataProcess(); 
         *  */
        //$this->outputStructure['ERROR']='(Test 2) ';$this->onFailure($this->eventFailure);
        //$this->outputStructure['ERROR']=NULL;$this->onSuccess($this->eventSuccess);
    }
    
}

