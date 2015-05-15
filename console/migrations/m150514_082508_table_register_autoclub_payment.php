<?php

class m150514_082508_table_register_autoclub_payment extends CDbMigration
{
	public function up()
	{
            $this->createTable('autoclub_payment_register', 
                    array(
                        'user_id' => 'int(11) NOT NULL',
                        'date' => 'timestamp DEFAULT CURRENT_TIMESTAMP',
                        'st1' => 'int(3) NOT NULL DEFAULT 0',
                        'st2' => 'int(3) NOT NULL DEFAULT 0',
                        'st3' => 'int(3) NOT NULL DEFAULT 0',
                        'PRIMARY KEY (user_id)'
                    ),
                    'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('autoclub_payment_register');
	}

}