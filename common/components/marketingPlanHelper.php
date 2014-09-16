<?php
/* помогает вернуть полную структуру актуальной (выбранной текущей) версии маркетинг-плана *
 * Стандарт описания структуры
 * price_activation - $20   - deault
 * price_start      - $50   - deault
 * ................ ................ ................ ................
 * percent_to_A     - 20%   - default   процент уходящий на кошелек A
 * percent_pot_B1   - 0.5%  - default   процент призового фонда для B1
 * percent_pot_B2   - 1.5%  - default   процент призового фонда для B2
 * percent_pot_B3   - 3%    - default   процент призового фонда для B3
 * percent_to_F     - 5%    - default   процент   вывода  на кошелек F
 * cost_B1          - 100   - default   стоимость статуса B1
 * cost_B2          - 500   - default   стоимость статуса B2
 * cost_B3          - 1000  - default   стоимость статуса B3
 * ................ ................ ................ ................
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
           'cost_B1' => 0.00,
           'cost_B2' => 0.00,
           'cost_B3' => 0.00,
       );
       Yii::import('common.models.Mpversions');
       $model = Mpversions::activeVersion();
       if(!isset($model->mathparams)){ throw new CHttpException ('500', 'Marketing plan version is failure. Set just one active version of marketing plan'); }
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
          throw new CHttpException('500', 'Unknown MP parameter');
      }
   }
   public function getMpParams(){
       if($buff = array_search(0, $this->structure) == FALSE){
           return $this->structure;
       } else {
           throw new CHttpException('500', 'Undefined MP parameters has');
       }
   }
}
