<?php
/**
 * Creator: Tkachenko Egor
 * Date: 12.08.14
 */
class Faqm extends CFormModel {
    const ITEM = 'FAQ_MANAGER';
    public $financialMail;
    public $offerMail;
    public $performanceMail;


    public function rules(){
        return array(
            array('financialMail, offerMail, performanceMail', 'safe' ),
        );
    }


    public function LoadFaqManager(){
        $dbc = Yii::app()->db;
        $load = $dbc->createCommand('SELECT content FROM itemsstorage WHERE item="'.self::ITEM.'"');
        $data = $load->query();
        $dump = $data->read();
        $decodedObject = json_decode($dump['content'], true);
        $this->financialMail = (isset($decodedObject['financialMail'])) ? $decodedObject['financialMail'] : '';
        $this->offerMail = (isset($decodedObject['offerMail'])) ? $decodedObject['offerMail'] : '';
        $this->performanceMail = (isset($decodedObject['performanceMail'])) ? $decodedObject['performanceMail'] : '';
    }
    public function SaveFaqManager(){
        $prepare = array(
            'financialMail' => $this->financialMail,
            'offerMail' => $this->offerMail,
            'performanceMail' => $this->performanceMail,
        );

        $prepare = json_encode($prepare, JSON_UNESCAPED_UNICODE);
        $saveKind = ($this->checkInstance() == false) ? 'INSERT INTO' : 'UPDATE';
        $variant1 = ' itemsstorage SET item = "'.self::ITEM.'", content = \'' . $prepare . '\''; // insert
        $variant2 = ' itemsstorage SET content = \''.$prepare.'\' where item = "'.self::ITEM . '"'; // update
        $command = ($this->checkInstance() == false) ? $variant1 : $variant2;
        $saveCommand = Yii::app()->db->createCommand($saveKind . $command . ';');
        $saveCommand->execute();
    }
    private function checkInstance(){
        $checkCommand = Yii::app()->db->createCommand('SELECT content FROM itemsstorage WHERE item="'.self::ITEM.'"');
        $result = $checkCommand->query();
        return $result->read();
    }
}

