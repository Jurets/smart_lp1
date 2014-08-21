<?php
/* реализует интерфейс пользователя для работы с языковой частью базы данных */
class LanguageInterphace extends CFormModel {
    public $languages; // структура для построения языков Массив из массивов структур: array('lang'=>'', name=>'')
    public $translateList; // список переводов для указанного языка: ключ - слово из матрицы, значение - перевод для данного языка
    public $lang; // сигнатура языка, выбранная как текущая
    public function __construct() {
        $this->languages = array(); 
        $this->translateList = array();
    }
    public function renderLanguages(){
        $this->languages = Yii::app()->db->createCommand('SELECT * FROM Languages')->query()->readAll();
    }
    public function addLanguage(){
        if( isset($_POST['lang']) && isset($_POST['name']) ){
        $lang = $_POST['lang']; $name = $_POST['name'];
          try {
               $sql = 'INSERT INTO Languages (lang, name) VALUES("'.$lang.'","'.$name.'");';
               Yii::app()->db->createCommand($sql)->execute();
               $sql2 = 'INSERT INTO SourceMessage (message) VALUES("'.$name.'");';
               Yii::app()->db->createCommand($sql2)->execute();
                echo '<script> alert("'.Yii::t('rec','New Language added successfull').'");</script>';
               } catch (Exception $exc) {
                echo '<script> alert("'.Yii::t('rec', 'This Language alredy present').'");</script>';
               }
        }
    }
    
    public function deleteLanguage(){
       
        if(isset($_POST['lang'])){
            $lang = $_POST['lang'];
            try {
                $sql = 'DELETE FROM Languages WHERE lang="'.$lang.'";';
                if(Yii::app()->db->createCommand($sql)->execute() != 0)
                echo '<script> alert("'.Yii::t('rec', $lang.' : '.'Language deleted successfull').'");</script>';
            }catch (Exception $exc){
                echo '<script>'.$exc->getTraceAsString().'</script>';
            }
        }
    }
    public function showTranslation(){
        /*
         * Образец
         * SELECT sm.id, sm.message, m.translation FROM SourceMessage sm
           LEFT JOIN Message m ON sm.id = m.id AND m.language = 'ru'
           WHERE m.language = 'ru' OR m.language IS NULL  */
        
            if(isset($_POST['lang'])){
                $this->lang = $_POST['lang'];
                $sql = "SELECT sm.id, sm.message, m.translation FROM SourceMessage sm
                        LEFT JOIN Message m ON sm.id = m.id AND m.language = :lang
                        WHERE m.language = :lang OR m.language IS NULL";
                $command = Yii::app()->db->createCommand($sql);
                $command->bindParam(':lang', $this->lang, PDO::PARAM_STR);
                $res = $command->query()->readAll();
                $this->translateList = $res;
            }
    }
    public function createTranslation(){
        if(isset($_POST['language']) && isset($_POST['lang']) ){
            $sql = 'INSERT INTO Message (id, language, translation) VALUES ';
            foreach($_POST['language']['id'] as $ind=>$number){
                if(empty($_POST['language']['translation'][$ind])) continue;
                $sql .= '(';
                $sql .= (int)$number.', ';
                $sql .= "'".$_POST['lang']."', ";
                if(strpos($_POST['language']['translation'][$ind], '"') !=FALSE){
                    $sql .= "'".$_POST['language']['translation'][$ind]."',";
                }else{
                    $sql .= '"'.$_POST['language']['translation'][$ind].'"';
                }
                $sql .= '),';
            }
            $sql = substr_replace($sql, ';', strrpos($sql, ','));
            //var_dump($sql);
            if(Yii::app()->db->createCommand($sql)->execute() != 0)
                echo 'Edition completed';
            else 'Wrong edition, has error';
        }
    }
   
}
