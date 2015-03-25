<?php
    $subdomainCheck = BaseModule::getUserFromSubdomain();
  if(is_array($subdomainCheck)){
    $redirectUrl = "http://".Yii::app()->params['host.name']; // редирект
  }else{
    $redirectUrl = "http://".$subdomainCheck.'.'.Yii::app()->params['host.name'];
  }
?>
<form method="post" action="<?=$redirectUrl?>" id="about404">
    <input type="hidden" name="error404">
</form>
<?php
  /* Вместо желтого квадрата версия 1 - не дружит со статистикой - не используется  */
//  $subdomainCheck = BaseModule::getUserFromSubdomain();
//  if(is_array($subdomainCheck)){
//    $redirectUrl = "http://".Yii::app()->params['host.name']; // редирект
//  }else{
//    $redirectUrl = "http://".$subdomainCheck.'.'.Yii::app()->params['host.name'];
//  }
//  Yii::app()->getRequest()->redirect($redirectUrl);
  /*_*/

/* @var $this SiteController */
/* @var $error array */

//$this->pageTitle=Yii::app()->name . ' - Error';
//$this->breadcrumbs=array(
//	BaseModule::t('common', 'Error'),
//);
?>

<script>
    $(function(){
        $('#about404').submit();
    });
</script>