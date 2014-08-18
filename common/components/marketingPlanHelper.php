<?php
/* помогает вернуть полную структуру актуальной (выбранной текущей) версии маркетинг-плана *
 * Стандарт описания структуры
 * percent_to_A     - 20%   - default   процент уходящий на кошелек A
 * percent_pot_B1   - 0.5%  - default   процент призового фонда для B1
 * percent_pot_B2   - 1.5%  - default   процент призового фонда для B2
 * percent_pot_B3   - 3%    - default   процент призового фонда для B3
 * percent_to_F     - 5%    - default   процент   вывода  на кошелек F
 */
class marketingPlanHelper {
   private $structure;
   public function __construct(){
       $this->structure = array(
           'price_activation' => 0.00,
           'price_start' => 0.00,
           'percent_to_A' => 0.00,
           'percent_pot_B1' => 0.00,
           'percent_pot_B2' => 0.00,
           'percent_pot_B3' => 0.00,
           'percent_to_F' => 0.00,
       );
       Yii::import('common.models.Mpversions');
       $model = Mpversions::activeVersion();
       //var_dump($model->mathparams);die;
       foreach($model->mathparams as $item){
           $this->structure[$item->name] = (float)$item->value;
       }
       
   }
   public static function init(){
       $object = new marketingPlanHelper();
       return $object;
   }
   public function getMpParam($whatGet){
      if(isset($this->structure[$whatGet]) && $this->structure[$whatGet] != 0){
          return $this->structure[$whatGet];
      }else{
          throw new CHttpException('500', 'Unknown MP parametr');
      }
   }
   public function getMpParams(){
       if($buff = array_search(0, $this->structure) == FALSE){
           return $this->structure;
       }else{
           throw new CHttpException('500', 'Undefined MP parametrs has');
       }
   }
}
