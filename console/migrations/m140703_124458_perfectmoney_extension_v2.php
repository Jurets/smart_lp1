<?php

class m140703_124458_perfectmoney_extension_v2 extends CDbMigration
{
    private function Terminate(){
            $this->dropTable('pm_transaction_log');
            $this->dropTable('pm_transaction_kind');
            $this->dropTable('pm_transaction_error');
    }
    private function ReviveV1(){
            $this->createTable('pm_transaction_error', array(
                'err_id' => 'smallint(6) NOT NULL AUTO_INCREMENT',
                'value' => 'varchar(255) NOT NULL',
                'PRIMARY KEY (err_id)',
            ),
                'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
            $this->createTable('pm_transaction_kind', array(
                'kind_id' => 'smallint(6) NOT NULL AUTO_INCREMENT',
                'value' => 'varchar(255) NOT NULL',
                'PRIMARY KEY (kind_id)'
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
            $this->createTable('pm_transaction_log', array(
                'tr_id' => "int(11) NOT NULL AUTO_INCREMENT COMMENT 'счетчик денежных транзакций' ",
                'date' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата совершения денежной транзакции' ",
                'amount' => "double NOT NULL DEFAULT '0' COMMENT 'Сумма перевода' ",
                'currency' => "char(3) NOT NULL DEFAULT 'USD' COMMENT 'обозначение валюты USD EUR GLD' ",
                'tr_kind_id'=>"smallint(6) NOT NULL DEFAULT '0' COMMENT 'Детализация названия денежной операции' ",
                'tr_err_code'=>"smallint(6) NOT NULL DEFAULT '0' COMMENT 'Детализация названия ошибки' ",
                'PRIMARY KEY (tr_id)',
                'FOREIGN KEY (tr_kind_id) REFERENCES pm_transaction_kind (kind_id) ON DELETE CASCADE ON UPDATE CASCADE',
                'FOREIGN KEY (tr_err_code) REFERENCES pm_transaction_error (err_id) ON DELETE CASCADE ON UPDATE CASCADE'
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
    }
	public function up()
	{
            $this->Terminate();
            $this->createTable('pm_transaction_error', array(
                'err_id' => 'smallint(6) NOT NULL AUTO_INCREMENT',
                'description' => 'varchar(255) NOT NULL',
                'PRIMARY KEY (err_id)',
            ),
                'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
            $this->createTable('pm_transaction_kind', array(
                'kind_id' => 'smallint(6) NOT NULL AUTO_INCREMENT',
                'description' => 'varchar(255) NOT NULL',
                'PRIMARY KEY (kind_id)'
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
            $this->createTable('pm_transaction_log', array(
                'tr_id' => "int(11) NOT NULL AUTO_INCREMENT COMMENT 'счетчик денежных транзакций' ",
                'PRIMARY KEY (tr_id)',
                'date' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата совершения денежной транзакции' ",
                'from_user_id'=>'int(11) NOT NULL',
                'from_purse'=>'varchar(255) NOT NULL COMMENT "кошелек плательщика" ',
                'to_user_id'=>'int(11) NOT NULL',
                'to_purse'=>'varchar(255) NOT NULL COMMENT "кошелек получателя" ',
                'notation'=>'varchar(255) DEFAULT NULL COMMENT "поле для пометок" ',
                'amount' => "double NOT NULL DEFAULT '0' COMMENT 'Сумма перевода' ",
                'currency' => "char(3) NOT NULL DEFAULT 'USD' COMMENT 'обозначение валюты USD EUR GLD' ",
                'tr_kind_id'=>"smallint(6) DEFAULT NULL COMMENT 'Детализация названия денежной операции' ",
                'tr_err_code'=>"smallint(6) DEFAULT NULL COMMENT 'Детализация названия ошибки' ",
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
            $this->addForeignKey('fk_err', 'pm_transaction_log', 'tr_err_code', 'pm_transaction_error', 'err_id','RESTRICT', 'RESTRICT');
            $this->addForeignKey('fk_knd', 'pm_transaction_log', 'tr_kind_id', 'pm_transaction_kind', 'kind_id','RESTRICT', 'RESTRICT');
            $this->addForeignKey('fk_from_usr', 'pm_transaction_log', 'from_user_id', 'tbl_users', 'id', 'RESTRICT', 'RESTRICT');
            $this->addForeignKey('fk_to_usr', 'pm_transaction_log', 'to_user_id', 'tbl_users', 'id', 'RESTRICT', 'RESTRICT');
            
	}

	public function down()
	{
            /* База данных восстанавливается */
            $this->Terminate();
            $this->ReviveV1();
	}
        
}