<?php
/* реализует интерфейс пользователя для работы с языковой частью базы данных */
class LanguageInterphace extends CFormModel {
    public $languages; // структура для построения языков Массив из массивов структур: array('lang'=>'', name=>'')
    public $translateList; // список переводов для указанного языка: ключ - слово из матрицы, значение - перевод для данного языка
    public $lang; // сигнатура языка, выбранная как текущая
    public function __construct() {
        $this->languages = array(); 
        $this->translateList = array();
        $this->lang = NULL;
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
       
        if(isset($_POST['lang']) && isset($_POST['langName'])){
            $lang = $_POST['lang'];
            $langName = $_POST['langName'];
            try {
                $sql = 'DELETE FROM Languages WHERE lang="'.$lang.'";';
                $sql2 = 'DELETE FROM SourceMessage WHERE message="'.$langName.'";';
                if(Yii::app()->db->createCommand($sql)->execute() != 0 && Yii::app()->db->createCommand($sql2)->execute() != 0)
                echo '<script> alert("'.Yii::t('rec', $lang.' : '.'Language deleted successfull').'");</script>';
            }catch (Exception $exc){
                echo '<script>'.$exc->getTraceAsString().'</script>';
            }
        }
    }
    public function showTranslation(){
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
    public function prepareTranslation(){
        if(!empty($this->translateList) && !is_null($this->lang)){
            $sql = 'INSERT INTO Message (id, language) VALUES ';
            foreach($this->translateList as $item){
                $sql .= '(';
                $sql .= (int)$item['id'].', ';
                $sql .= '"'.$this->lang.'"';
                $sql .= '),';
            }
            $sql = substr_replace($sql, ';', strrpos($sql, ','));
            try{
                Yii::app()->db->createCommand($sql)->execute();
            }  catch (CException $ce){
                ;
            }
        }
    }
  
  public function createTranslation(){
      if(isset($_POST['language']) && isset($_POST['lang']) ){
          foreach($_POST['language']['id'] as $ind=>$number){
              if(empty($_POST['language']['translation'][$ind])) continue;
              $buff = $_POST['language']['translation'][$ind];
              $sql = "UPDATE Message SET translation=".'"'.htmlspecialchars($buff).'"';
              $sql .= ' WHERE id='.(int)$number.' AND language="'.$_POST['lang'].'";';
              Yii::app()->db->createCommand($sql)->execute();
          }
              echo 'Edition completed';
                
      }
   }
   
   // формирует список существующих локалей в Yii для передачи его во вью
   // язык по умолчанию - en - из списка локалей должен быть исключен
   public function localeList(){
       $widget = '<select>';
       $buff = CLocale::getLocaleIDs();
       foreach($buff as $locale){
           if(strpos($locale, '_') != FALSE || $locale == 'en') continue;
           $widget .= '<option name="lang" value="'.$locale.'">'.$locale.'</option>';
       }
       $widget .= '</select>';
       return $widget;
   }   
}
