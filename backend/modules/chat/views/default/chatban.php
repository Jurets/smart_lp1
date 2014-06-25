<?php
/* @var $this DefaultController */
/* @var $user User */
/* @var $form TbActiveForm */

$this->breadcrumbs=array(
    'Чат'=>array('admin'),
    'Поиск'=>array('search'),
    $user->username,
);

$this->menu=array(
    array('label'=>'Сообщения', 'url'=>array('admin')),
    //array('label'=>'Поиск', 'url'=>array('search')),
);
?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true,
)); ?>

<?php if (isset($chatban->id)) { ?>
    <h1>Участник заблокирован</h1>
<?php } else { ?>
    <h1>Заблокировать участника <?php //echo $user->id; ?></h1>
<?php } ?>
    
<?php $this->widget('yiiwheels.widgets.detail.WhDetailView', array(
    'data'=>$user,
    'attributes'=>array(
        'id',
        'username',
        'email',
        'create_at',
        'first_name',
        'last_name',
    ),
)); 

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'method'=>'post',
    'id'=>'ban-form',
)); 
    if (isset($chatban->id)) {
        $this->widget('yiiwheels.widgets.detail.WhDetailView', array(
            'data'=>$chatban,
            'attributes'=>array(
                'create_at',
                'bantype.name',
                'comment',
            ),
        ));
        echo $form->hiddenField($chatban, 'id');
        echo TbHtml::submitButton('Разблокировать', array('name'=>'submit_unban', 'color' => TbHtml::BUTTON_COLOR_PRIMARY));
    } else {
        //выбрать тип бана
        echo $form->dropDownListControlGroup($chatban, 'bantype_id', TbHtml::listData(BanType::getBanTypes(), 'id', 'name'), array('class'=>'span5', 'displaySize'=>'1', 'prompt'=>'<выбор>'));
        //информация о причине бана
        echo $form->textFieldControlGroup($chatban, 'comment', array('class'=>'span8'));
        echo TbHtml::submitButton('Заблокировать', array('name'=>'submit_ban', 'color' => TbHtml::BUTTON_COLOR_PRIMARY));
    }
$this->endWidget();
?>