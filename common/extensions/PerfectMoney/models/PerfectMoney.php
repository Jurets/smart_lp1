<?php
/* Базовая модель */
class PerfectMoney extends CFormModel {
   public $login;
   public $password;
   
   public function rules(){
       return array(
           array('login', 'password', 'required'),
       );
   }
   
   
}