<?php

class m140717_070637_payment_instructions_system extends CDbMigration
{
  public function safeUp()
  {
        $this->createTable('sip_periodes', array(
            'id'=>'INT(11) NOT NULL AUTO_INCREMENT COMMENT "обычный счетчик" ',
            'begin'=>'TIMESTAMP DEFAULT "0000-00-00 00:00:00" COMMENT "начало расчетного периода" ',
            'end'=>'TIMESTAMP DEFAULT "0000-00-00 00:00:00" COMMENT "конец расчетного периода"',
            'closed'=>'INT(1) DEFAULT 0 COMMENT "признак закрытия (1) расчетного периода " ',
            'PRIMARY KEY(id)',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->createTable('sip_instructions', array(
            'id'=>'INT(11) NOT NULL AUTO_INCREMENT COMMENT "обычный счетчик" ',
            'period_id'=>'INT(11) NOT NULL COMMENT "fk_ ссылка на sip_periodes" ',
            'user_id'=>'INT(11) DEFAULT NULL COMMENT "fk_ ссылка на tbl_users NULL ? system_purse : user_purse" ',
            'purse'=>'VARCHAR(255) DEFAULT NULL COMMENT "для системных кошельков" ',
            'amount'=>'DOUBLE DEFAULT NULL COMMENT "сумма денег в операции" ',
            'instruction_result'=>' INT(1) DEFAULT 0 COMMENT "флаг завершения операции (0) " ',
            'log_reff'=>'INT(11) DEFAULT NULL COMMENT "fk_ ссылка на операции pm_transaction_log" ',
            'PRIMARY KEY(id)',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        // Установка ключей
        $this->addForeignKey('fk_periodes', 'sip_instructions', 'period_id', 'sip_periodes', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_usr0ods', 'sip_instructions', 'user_id', 'tbl_users', 'id', 'RESTRICT', 'RESTRICT');
        $this->addColumn('pm_transaction_log', 'instruction_id', 'INT(11) DEFAULT NULL COMMENT "fk_ ссылка на sip_instructions" ');
        $this->addForeignKey('fk_instr', 'pm_transaction_log', 'instruction_id', 'sip_instructions', 'id', 'RESTRICT', 'RESTRICT');
     
  }

 public function safeDown()
  {
    
        $this->dropForeignKey('fk_periodes', 'sip_instructions');
        $this->dropForeignKey('fk_usr0ods', 'sip_instructions');
        $this->dropForeignKey('fk_instr', 'pm_transaction_log');
        $this->dropColumn('pm_transaction_log', 'instruction_id');
        $this->dropTable('sip_periodes');
        $this->dropTable('sip_instructions');
  }

}