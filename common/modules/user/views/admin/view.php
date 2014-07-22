<?php
$this->breadcrumbs = array(
    UserModule::t('Unified database participants', array(), 'participant') => array('admin'),
    $model->username,
);


$this->menu = array(
    array('label' => UserModule::t('Create User'), 'url' => array('create')),
    array('label' => UserModule::t('Update User'), 'url' => array('update', 'id' => $model->id)),
    // array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
    array('label' => UserModule::t('Manage Users'), 'url' => array('admin')),
    array('label' => UserModule::t("See structure", array(), 'participant'), 'url' => Yii::app()->controller->createUrl("seestructure", array("id" => $model->id))),
        //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
        //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);
?>
<h1><?php echo UserModule::t('View User') . ' "' . $model->username . '"'; ?></h1>

<?php
$attributes = array(
    'id',
    'username',
);

/* $profileFields=ProfileField::model()->forOwner()->sort()->findAll();
  if ($profileFields) {
  foreach($profileFields as $field) {
  array_push($attributes,array(
  'label' => UserModule::t($field->title),
  'name' => $field->varname,
  'type'=>'raw',
  'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
  ));
  }
  } */
if(empty($model->photo)){
    $photo = '';
}else{
    $photo = CHtml::image(Yii::app()->createAbsoluteUrl( "/uploads/" . $model->photo));
}
array_push($attributes, 'password', 'first_name', 'last_name', 'skype', 'phone', 'email', 'activkey', 'create_at', 'lastvisit_at', 'username',  array(
    'name' => UserModule::t('Photo'),
    'type' => 'raw',
    'value' => $photo
        ), array(
    'name' => 'superuser',
    'value' => User::itemAlias("AdminStatus", $model->superuser),
        ), array(
    'name' => 'status',
    'value' => User::itemAlias("UserStatus", $model->status),
        )
);

$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => $attributes,
));
?>
