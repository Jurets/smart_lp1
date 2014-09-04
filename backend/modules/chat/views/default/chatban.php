<?php
/* @var $this DefaultController */
/* @var $user User */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
    //BaseModule::t('rec', 'Chat')=>array('admin'),
    BaseModule::t('rec', 'Chat') . BaseModule::t('rec', 'Blocking') => array('search'),
    //BaseModule::t('rec', 'Search')=>array('search'),
    //$user->username,
);

if (isset($user->username)) {
    $this->breadcrumbs[] = $user->username;
}

$this->menu=array(
    array('label'=>BaseModule::t('rec', 'Chat messages'), 'url'=>array('admin')),
    //array('label'=>'Поиск', 'url'=>array('search')),
);
?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true,
)); ?>

<h1><?php echo BaseModule::t('rec', isset($chatban->id) ? 'Participant is blocked' : 'Block participant'); ?></h1>
    
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
        echo TbHtml::submitButton(BaseModule::t('rec', 'Unlock'), array('name'=>'submit_unban', 'color' => TbHtml::BUTTON_COLOR_PRIMARY));
    } else {
        //выбрать тип бана
        echo $form->dropDownListControlGroup($chatban, 'bantype_id', TbHtml::listData(BanType::getBanTypes(), 'id', 'name'), array('class'=>'span5', 'displaySize'=>'1', 'prompt'=>'<' . BaseModule::t('rec', 'select') . '>'));
        //информация о причине бана
        echo $form->textFieldControlGroup($chatban, 'comment', array('class'=>'span8'));
        echo TbHtml::submitButton(BaseModule::t('rec', 'Block'), array('name'=>'submit_ban', 'color' => TbHtml::BUTTON_COLOR_PRIMARY));
    }
$this->endWidget();
?>