<?php

class m140702_144101_perfectmoney_extension_v1 extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function up()
	{
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

	public function down()
	{
            $this->dropTable('pm_transaction_log');
            $this->dropTable('pm_transaction_kind');
            $this->dropTable('pm_transaction_error');
	}

}