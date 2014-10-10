<?php
$this->widget('application.widgets.UserContour.UserContour',
        array( 'params' => array( 
        'cssID' => 1,
        'head' => BaseModule::t('rec', 'REGISTERED MEMBERS'),
        'title'=> BaseModule::t('common', 'CURRENT REGISTRATION'),
    )));
$this->widget('application.widgets.UserContour.UserContour',
        array( 'params' => array(
            'cssID' => 2,
            'head' => BaseModule::t('rec', 'FEE PAID'),
            'title'=> BaseModule::t('rec', 'CURRENT PAYMENTS'),
        )));
$this->widget('application.widgets.UserContour.UserContour',
        array( 'params' => array(
            'cssID' => 3,
            'head' => BaseModule::t('rec', 'GIVEN ON CHARITY'),
            'title'=> BaseModule::t('rec', 'CURRENT FEES'),
        ))); ?>
