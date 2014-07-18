<h3><?php if($model->hasErrors()) echo 'ошибки' ?></h3>
<?php
echo TbHtml::beginForm('/admin/siap/default/periodmanually');
$label_begin = 'begin period';
$label_end = 'end period';
echo $model->getError('begin');
echo TbHtml::label($label_begin, 'begin');
echo '<br>';
echo TbHtml::textField('begin', $model->begin, array('id'=>'begin'));
echo '<br><br>';
echo $model->getError('end');
echo TbHtml::label($label_end, 'end');
echo '<br>';
echo TbHtml::textField('end', $model->end, array('id'=>'end'));
echo '<br><br>';
echo TbHtml::submitButton('submit', array('value'=>'send'));
echo TbHtml::endForm();

