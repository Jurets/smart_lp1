<?php

class m140908_154502_langpatch_01 extends ProjectMigration
{
	public function up()
	{
            $this->insert('SourceMessage', 
                    array(
                            'message'=>'INCOME',
                            'message'=>'checks today',
                            'message'=>'Show part',
                            'message'=>'WITHDROAW FUNDS',
                            'message'=>'VISIT',
                            'message'=>'private in team',
                            'message'=>'In this month',
                            'message'=>'CHARITY',
                            'message'=>'VISITS',
                            'message'=>'private team today',
                            'message'=>'Business Club today',
                            'message'=>'Total in today',
                            'message'=>'Total income received',
                        )
            );
            $this->insert('SourceMessage', array('message'=>'INCOME'));
            $this->insert('SourceMessage', array('message'=>'checks today'));
            $this->insert('SourceMessage', array('message'=>'Show part'));
            $this->insert('SourceMessage', array('message'=>'WITHDROAW FUNDS'));
            $this->insert('SourceMessage', array('message'=>'VISIT'));
            $this->insert('SourceMessage', array('message'=>'private in team'));
            $this->insert('SourceMessage', array('message'=>'In this month'));
            $this->insert('SourceMessage', array('message'=>'CHARITY'));
            $this->insert('SourceMessage', array('message'=>'VISITS'));
            $this->insert('SourceMessage', array('message'=>'private team today'));
            $this->insert('SourceMessage', array('message'=>'Business Club today'));
            $this->insert('SourceMessage', array('message'=>'Total in today'));
            $this->insert('SourceMessage', array('message'=>'Total income received'));
            
            $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'puspatch01.sql');
	}

	public function down()
	{
		
	}

}