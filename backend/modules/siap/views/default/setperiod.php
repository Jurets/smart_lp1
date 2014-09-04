<?php
echo TbHtml::beginForm('/admin/siap/default/periodmanually');
$label_begin = BaseModule::t('rec', 'begin period for one week').'<br> (yyyy-mm-dd hh:mm:ss)';
echo ($check == true) ? $model->getError('begin') : '';
echo TbHtml::label($label_begin, 'begin');
echo '<br>';
echo TbHtml::textField('begin', $model->begin, array('id'=>'begin'));
echo '<br><br>';
echo TbHtml::submitButton('submit', array('value'=>'send'));
echo TbHtml::endForm();
