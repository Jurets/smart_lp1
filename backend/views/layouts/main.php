 <?php Yii::app()->clientScript->registerCorescript('jquery') ?>
 <?php Yii::app()->clientScript->registerCorescript('jquery.ui') ?>
<?php
// test comment
/**
 *
 * main.php layout
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="<?=Yii::app()->createAbsoluteUrl('/')?>/css/bootstrap.min.css">
	<style>
		body {
			padding-top: 60px;
			padding-bottom: 40px;
		}
	</style>

	<link rel="stylesheet" href="<?=Yii::app()->createAbsoluteUrl('/')?>/css/main.css">

	<script src="<?=Yii::app()->createAbsoluteUrl('/')?>/js/libs/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	
<script src="<?= Yii::app()->request->baseUrl; ?>/js/file-upload/jquery.ui.widget.js"></script>
<script src="<?= Yii::app()->request->baseUrl; ?>/js/file-upload/jquery.iframe-transport.js"></script>
<script src="<?= Yii::app()->request->baseUrl; ?>/js/file-upload/jquery.fileupload.js"></script>
	
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
	your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
	improve your experience.</p>
<![endif]-->

<!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container" style="width: 1700px;">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#">Project name</a>

			<div class="nav-collapse collapse">
            <?php
                $this->widget('zii.widgets.CMenu', array(
                'htmlOptions'=>array('class' => 'nav'),
                'items'=>array(
                    array('url'=>Yii::app()->getModule('user')->indexUrl, 'label'=>UserModule::t("Users"), 'visible'=>!Yii::app()->user->isGuest),

                    array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
                    array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
                    array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
                    array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
					array('url'=>Yii::app()->getModule('news')->newsShow, 'label'=>Yii::app()->getModule('news')->t("News")),
                    array('url'=>Yii::app()->getModule('training')->trainingShow, 'label'=>Yii::app()->getModule('training')->t("Training")),
                    array('url'=>Yii::app()->getModule('cities')->citiesShow, 'label'=>Yii::app()->getModule('cities')->t("Cities")),
                    array('url'=>Yii::app()->getModule('faq')->faqShow, 'label'=>Yii::app()->getModule('faq')->t("FAQ")),

                ),
            ));

             ?>
<!--				<ul class="nav">
                    <li class="<?=Yii::app()->user->isGuest ? ' ' : 'hide'?>"><a href="<?=Yii::app()->createAbsoluteUrl('user/login')?>">Login</a></li>
                    <li class="<?=!Yii::app()->user->isGuest ? ' ' : 'hide'?>"><a href="<?=Yii::app()->createAbsoluteUrl('user/logout')?>">Logout</a></li>
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li class="nav-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>-->
<!--				<form class="navbar-form pull-right">
					<input class="span2" type="text" placeholder="Email">
					<input class="span2" type="password" placeholder="Password">
					<button type="submit" class="btn">Sign in</button>
				</form>-->
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
</div>
<div class="w-1000 m-center" style="width: 1700px;">
<?php echo $content; ?>
</div>
<!--  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<!--  <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>  -->
<script src="<?=Yii::app()->createAbsoluteUrl('/')?>/js/libs/bootstrap.min.js"></script>
<script src="<?=Yii::app()->createAbsoluteUrl('/')?>/js/plugins.js"></script>
<script src="<?=Yii::app()->createAbsoluteUrl('/')?>/js/main.js"></script><script>
	var _gaq = [
		['_setAccount', 'UA-XXXXX-X'],
		['_trackPageview']
	];
	(function (d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g, s)
	}(document, 'script'));
</script>
</body>
</html>