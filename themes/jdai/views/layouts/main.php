<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />  -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />  -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	
	<!--Core CSS -->
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl?>/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl?>/css/bootstrap-reset.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl?>/js/gridforms/gridforms.css">
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl?>/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl?>/css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<?php if(Yii::app()->user->isGuest) { ?>
	<body class="login-body">
<?php }else{ ?>
	<body class="full-width">
<?php } ?>


<?php $this_user = User::model()->findByPk(Yii::app()->user->id); ?>


<section id="container" class="hr-menu">

<?php if(!Yii::app()->user->isGuest) { ?>
	<header class="header fixed-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle hr-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="fa fa-bars"></span>
            </button>
			
			<div class="brand ">
				<a href="/" class="logo" title="<?php echo CHtml::encode(Yii::app()->name); ?>">
					<img src="<?=Yii::app()->theme->baseUrl?>/images/logo.png" alt="">
				</a>
			</div>
			
			<div class="horizontal-menu navbar-collapse collapse ">
                <?php $this->widget('zii.widgets.CMenu',array(
					'htmlOptions'=>array('class'=>'nav navbar-nav'),
					'items'=>array(
                        array('label'=>'Main', 'url'=>array('/detention/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Manage Users', 'url'=>array('/user/index'), 'visible'=>Yii::app()->user->checkAccess('account_admin')),
						array('label'=>'Manage Facilities', 'url'=>array('/facility/index'), 'visible'=>Yii::app()->user->checkAccess('account_admin'))
					),
				)); ?>
            </div>
			
			<div class="top-nav hr-top-nav">
				<ul class="nav pull-right top-menu">
					<li>
						<span class="form-control">
						<?php
                        if(Yii::app()->user->checkAccess('state_admin')){

                            $form=$this->beginWidget('CActiveForm', array('id'=>'user-form', 'enableAjaxValidation'=>true));

                            $this_user = User::model()->findByPk(Yii::app()->user->id);
                            $modelCounty = City::model()->findAll(array('condition'=>'state_code=:state_code', 'params'=>array(":state_code"=> $this_user->state), 'order' => 'county'));
                            $county_arr = CHtml::listData($modelCounty,'county','county');
                            foreach($county_arr as $key => $val){
                                if (empty($val)) unset($county_arr[$key]);
                            }
                            $county_arr['ALL'] = 'ALL';

                            echo CHtml::activeDropDownList(
                                $this_user,
                                'county',
                                $county_arr,
                                array(
                                    'submit'=>array('user/ajaxupdate', 'id'=>$this_user->id),
                                    'style' => 'border: none;',
                                    'class' => 'maincounty'
                                )

                            );
                            if($this_user->state) echo ' ('.$this_user->state.')';

                            $this->endWidget();

                         }else{
                            if($this_user->county) echo $this_user->county;
                            if($this_user->state) echo ' ('.$this_user->state.')';
                         }
                        ?>
						</span>
					</li>
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="username"><?=Yii::app()->user->name?></span>
							<b class="caret"></b>
						</a>
						<?php $this->widget('zii.widgets.CMenu',array(
							'encodeLabel' => false,
							'htmlOptions'=>array('class'=>'dropdown-menu extended logout'),
							'items'=>array(
							array('label'=>'<i class="fa fa-key"></i> Logout', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
							),
						)); ?>
					</li>
				</ul>
              </div>
			
		</div>
	</header>
<?php } ?>

<section id="content">
    <section class="wrapper">
		<?php echo $content; ?>
	</section>
</section>
	
</section><!-- page -->

<!--Core js-->
<?php
Yii::app()->getClientScript()->registerScriptFile( Yii::app()->theme->baseUrl.'/bs3/js/bootstrap.min.js' );
Yii::app()->getClientScript()->registerScriptFile( Yii::app()->theme->baseUrl.'/js/custom.js' );
?>

</body>
</html>
