<?php

class m140718_181145_instr_add_trkind extends CDbMigration
{
  public function safeUp()
  {
        $this->addColumn('sip_instructions', 'tr_kind_id', 'SMALLINT(6) DEFAULT NULL COMMENT "ссылка на ИД типа транзакции"');
        // Установка ключей
        //$this->addForeignKey('fk_instr_trkind', 'sip_instructions', 'tr_kind_id', 'pm_transaction_log', 'kind_id', 'RESTRICT', 'RESTRICT');
  }

 public function safeDown()
  {
        //$this->dropForeignKey('fk_instr_trkind', 'sip_instructions');
        $this->dropColumn('sip_instructions', 'tr_kind_id');
  }

}