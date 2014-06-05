<?php
/*
 * типовой виджет для отображения информации по юзерам (3 вида)
 */
class UserContour extends CWidget {
    public $params = array(
        'action' => 'index',
        'cssID' => 1,
        'head' => 'ЗАРЕГИСТРИРОВАНО УЧАСТНИКОВ',
        'title'=> 'ТЕКУЩИЕ РЕГИСТРАЦИИ',
    );
    private $dataPull = array(
        'numberField' => '00 000 000', // поле с цифрами (должно быть отформатировано)
        'userList' => array( // данные по пользователям для списка li
           array( 
            'country' => '', // название страны (записывается в id списка li - например, UA)
            'content' => '', // 12:51 UTC Фамилия Имя (en)
           ),
        ), 
    );
  
    public function run(){
        switch($this->params['cssID']){
            case 1:
                $this->registeredPartipiants();
                break;
            case 2:
                break;
            case 3:
                break;
        }
       $this->render('UserContour', array('features'=>$this->params, 'dataPull'=>$this->dataPull));
    }
    
    /**/
    private function registeredPartipiants(){
        // TO DO - получить, отформатировать и записать в dataPull ответ для ЗАРЕГИСТРИРОВАНО УЧАСТНИКОВ
        /* Приблизительно хардкод  выполнить запрос и произвести соответствующее форматирование форматирование*/
        $this->dataPull['numberField'] = '11 222 333';
        
        $this->dataPull['userList'][0]['country'] = 'tailand';
        $this->dataPull['userList'][0]['content'] = '00:06 UTC Человек раз';
        
        $this->dataPull['userList'][1]['country'] = 'UA';
        $this->dataPull['userList'][1]['content'] = '00:05 UTC Человек два';
        
        $this->dataPull['userList'][2]['country'] = 'RU';
        $this->dataPull['userList'][2]['content'] = '00:04 UTC Человек три';
        
        $this->dataPull['userList'][3]['country'] = 'UK';
        $this->dataPull['userList'][3]['content'] = '00:03 UTC Человек четыре';
        
        $this->dataPull['userList'][4]['country'] = 'AU';
        $this->dataPull['userList'][4]['content'] = '00:02 UTC Человек пять';
        
        $this->dataPull['userList'][5]['country'] = 'PL';
        $this->dataPull['userList'][5]['content'] = '00:01 UTC Человек шесть';
        
    }
    private function freePaid(){
        // TO DO - получить, отформатировать и записать в dataPull ответ для ВЫПЛАЧЕНО КОМИССИОННЫХ 
    }
    private function givenOncharity(){
        // TO DO - получить, отформатировать и записать в dataPull ответ для ОТДАНО НА БЛАГОТВОРИТЕЛЬНОСТЬ
    }
}
