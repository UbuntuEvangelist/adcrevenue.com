<?php
/**
 * @var $this yii\web\View
 */
use app\assets\DashboardAsset;
use app\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use machour\yii2\notifications\widgets\NotificationsWidget;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
    <div class="wrapper">
        <!-- header logo: style can be found in header.less -->
        <header class="main-header">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo Yii::$app->name ?>				
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"><?php echo Yii::t('app', 'Toggle navigation') ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?php 
						NotificationsWidget::widget([
						'theme' => NotificationsWidget::THEME_GROWL,
						'clientOptions' => [
								'location' => 'br',
							],
							'counters' => [
								'.notifications-header-count',
								'.notifications-icon-count'
							],
							'listSelector' => '#notifications',
						]); 
					?>
					<li class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<span class="label label-warning notifications-icon-count">0</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have <span class="notifications-header-count">0</span> notifications</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<div id="notifications"></div>
							</li>
							<!--<li class="footer"><a href="<?php //echo Url::to(['/notification/index']) ?>">View all</a></li>-->
						</ul>
					</li>												
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!--<img src="<?php //echo Yii::$app->user->identity->getImageurl(); ?>" class="user-image">-->
								<?php echo Html::img(Yii::$app->request->baseUrl.'/uploads/'. Yii::$app->user->identity->photo,['alt'=>'', 'class' => 'img-circle', 'width'=>'40px','height'=>'40px','title'=>'image title']); ?>
                                <span><?php echo Yii::$app->user->identity->username; ?> <i class="caret"></i></span>
                            </a>
							
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header light-blue">
                                    <!--<img src="<?php //echo Yii::$app->user->identity->getImageurl(); ?>" class="img-circle" alt="User Image" />-->
									<?php echo Html::img(Yii::$app->request->baseUrl.'/uploads/'. Yii::$app->user->identity->photo,['alt'=>'', 'class' => 'img-circle', 'width'=>'40px','height'=>'40px','title'=>'image title']); ?>
                                    <p>
                                        <?php echo Yii::$app->user->identity->username; ?>
                                        <small>
                                            <?php echo  'Member since ('.Yii::$app->user->identity->created_at .')' ?>
                                        </small>
                                </li>                                
                                <li class="user-footer">                                    
                                    <div class="text-center">
                                        <?php echo Html::a(Yii::t('app', 'Logout'), ['/site/logout'], ['class'=>'btn btn-default btn-flat', 'data-method' => 'post']) ?>
                                    </div>
                                </li>
                            </ul>
                        </li>                        
                    </ul>
                </div>
            </nav>
        </header>        
        <aside class="main-sidebar">            
            <section class="sidebar">                
                <div class="user-panel">
                    <div class="pull-left image">
                        <!--<img src="<?php //echo Yii::$app->user->identity->getPhotourl(); ?>" class="img-circle" />-->
						<?php echo Html::img(Yii::$app->request->baseUrl.'/uploads/'. Yii::$app->user->identity->photo,['alt'=>'', 'class' => 'img-circle', 'width'=>'40px','height'=>'40px','title'=>'image title']); ?>
                    </div>
                    <div class="pull-left info">
                        <h6><?php echo Yii::t('app', 'আস সালামু আলাইকুম, {username}', ['username'=>Yii::$app->user->identity->username]) ?></h6>
                        <a href="#">
                            <i class="fa fa-circle text-success"></i>
                            <?php echo Yii::$app->formatter->asDatetime(time()) ?>
                        </a>
                    </div>
                </div>
                <ul class="sidebar-menu">
					<li class="header">প্রধান গৌণ</li>
					<li class="treeview">
					  <a href="http://adcrevenue.com/web/dashboard/index">
						<i class="fa fa-dashboard"></i> <span>ড্যাশবোর্ড</span> 
					  </a>			 
					</li>
					<?php if(Yii::$app->user->can('admin')){ ?>
						<li class="header">মনিটরিং সিষ্টেম</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/user/index">
							<i class="fa fa-pie-chart"></i> <span>ইউজার লিস্ট</span>
						  </a>			 
						</li>
					<?php } ?>
					<li class="header">সার্ভে ট্রাইব্যুনাল মামলার</li>
					<li class="treeview">
					  <a href="http://adcrevenue.com/web/monitoringchok/index">
						<i class="fa fa-pie-chart"></i> <span>মনিটরিং ছক</span>
					  </a>			 
					</li>							
				</ul>
				<?php $userId = \Yii::$app->user->identity->userof; ?>
				<?php if($userId === 17) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>				
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot1">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ জেলা জজ আদালত</span> 
						  </a>			 
						</li>	
					</ul>
				<?php } elseif($userId === 18) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>				
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot2">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ জেলা জজ নিরাপত্তা আদালত</span> 
						  </a>			 
						</li>	
					</ul>
				<?php } elseif($userId === 19) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot3">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ স্প্রেসিয়াল জেলা জজ বিশেষ আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 20) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot4">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ অতিরিক্ত জেলা জজ ১ম আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 21) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot5">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ২য় আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 22) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot6">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ অতিরিক্ত জেলা জজ ৩য় আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 23) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot7">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ অতিরিক্ত জেলা জজ ৪র্থ আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 24) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot8">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ১ম আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 25) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot9">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ২য় আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 26) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot10">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ৩য় আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 27) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot11">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ৪র্থ আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 28) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot12">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ল্যান্ড সার্ভে ট্রাইব্যুনাল</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 29) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot13">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সিনিওর সহকারী জজ , সদর আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 30) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot14">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , লাকসাম আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 31) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot15">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , বগুড়া আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 32) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot16">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , নাঙ্গলকোট আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 33) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot17">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , চৌদ্দগ্রাম আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 34) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot18">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ ,চান্দিনা আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 35) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot19">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , বুড়িচং আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 36) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot20">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ, ব্রাহ্মণপাড়া আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 37) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot21">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , দেবীদ্বার আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 38) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot22">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , মুরাদনগর আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 39) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot23">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , দাউদকান্দি আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 40) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adalot24">
							<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ, হোমনা আদালত</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 1) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						   <a href="http://adcrevenue.com/web/barura">
							<i class="fa fa-pie-chart"></i> <span>বরুরা</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 2) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/chandina">
							<i class="fa fa-pie-chart"></i> <span>চান্দিনা</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 3) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/daudkandi">
							<i class="fa fa-pie-chart"></i> <span>দাউদকান্দি</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 4) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/laksam">
							<i class="fa fa-pie-chart"></i> <span>লাকসাম</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 5) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/brahmanpara">
							<i class="fa fa-pie-chart"></i> <span>ব্রাহ্মণপাড়া</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 6) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/burichong">
							<i class="fa fa-pie-chart"></i> <span>বুড়িচং</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 7) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/chauddagram">
							<i class="fa fa-pie-chart"></i> <span>চৌদ্দগ্রাম</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 8) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/debidwar">
							<i class="fa fa-pie-chart"></i> <span>দেবীদ্বার</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 9) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/homna">
							<i class="fa fa-pie-chart"></i> <span>হোমনা</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 10) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/muradnagar">
							<i class="fa fa-pie-chart"></i> <span> মুরাদনগর</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 11) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/nangalkot">
							<i class="fa fa-pie-chart"></i> <span>লাঙ্গলকোট</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 12) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/meghna">
							<i class="fa fa-pie-chart"></i> <span>মেঘনা</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 13) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/titas">
							<i class="fa fa-pie-chart"></i> <span>তিতাস</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 14) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/monohorgonj">
							<i class="fa fa-pie-chart"></i> <span>মনোহরগঞ্জ</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 15) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">				
						  <a href="http://adcrevenue.com/web/sadar">
							<i class="fa fa-pie-chart"></i> <span>কুমিল্লা সদর দক্ষিণ উপজেলা</span> 
						  </a>			 
						</li>
					</ul>
				<?php } elseif($userId === 16) { ?>
					<ul class="sidebar-menu">
						<li class="header">পেন্ডিং মোকাদ্দমা সমুহের তালিকা</li>	
						<li class="treeview">
						  <a href="http://adcrevenue.com/web/adarsa">
							<i class="fa fa-pie-chart"></i> <span>কুমিল্লা আদর্শ সদর উপজেলা</span> 
						  </a>			 
						</li>
					</ul>
				<?php } else { ?>
					<div id="TopMenu">
					  <div class="list-group panel" style="color:#222D32; background:#222d32;">
						<a href="#adalot" class="list-group-item list-group-item-primary"  data-toggle="collapse" data-parent="#TopMenu"><h6>বিজ্ঞ আদালত ভিত্তিক পেন্ডিং মোকাদ্দমা সমুহের তালিকা</h6></a>
						<div class="collapse" id="adalot">								
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot1">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ জেলা জজ আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot2">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ জেলা জজ নিরাপত্তা আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							   <a href="http://adcrevenue.com/web/adalot3">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ স্প্রেসিয়াল জেলা জজ বিশেষ আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot4">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ অতিরিক্ত জেলা জজ ১ম আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot5">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ অতিরিক্ত জেলা জজ ২য় আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot6">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ অতিরিক্ত জেলা জজ ৩য় আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot7">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ অতিরিক্ত জেলা জজ ৪র্থ আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot8">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ১ম আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot9">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ২য় আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot10">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ৩য় আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot11">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ৪র্থ আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot12">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ যুগ্ম জেলা জজ ল্যান্ড সার্ভে ট্রাইব্যুনাল</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot13">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সিনিওর সহকারী জজ , সদর আদালত </span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot14">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , লাকসাম আদালত </span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot15">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , বগুড়া আদালত </span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot16">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , নাঙ্গলকোট আদালত </span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot17">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , চৌদ্দগ্রাম আদালত </span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot18">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , চান্দিনা আদালত </span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot19">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , বুড়িচং আদালত </span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot20">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ, ব্রাহ্মণপাড়া আদালত </span> 
							  </a>			 
							</li>	
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot21">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ , দেবীদ্বার আদালত </span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot22">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ ,মুরাদনগর আদালত</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot23">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ দাউদকান্দি আদালত </span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adalot24">
								<i class="fa fa-pie-chart"></i> <span>বিজ্ঞ সহকারী জজ, হোমনা আদালত</span> 
							  </a>			 
							</li>	
						</div>
						<a href="#upazila" class="list-group-item list-group-item-primary" data-toggle="collapse" data-parent="#TopMenu"><h6>উপজেলাভিত্তিক পেন্ডিং মোকাদ্দমা সমুহের তালিকা</h6></a>
						<div class="collapse" id="upazila">			  				
							<li class="treeview">				
							  <a href="http://adcrevenue.com/web/sadar">
								<i class="fa fa-pie-chart"></i> <span>কুমিল্লা সদর দক্ষিণ উপজেলা</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/adarsa">
								<i class="fa fa-pie-chart"></i> <span>কুমিল্লা আদর্শ সদর উপজেলা</span> 
							  </a>			 
							</li>				
							<li class="treeview">
							   <a href="http://adcrevenue.com/web/barura">
								<i class="fa fa-pie-chart"></i> <span>বরুরা</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/chandina">
								<i class="fa fa-pie-chart"></i> <span>চান্দিনা</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/daudkandi">
								<i class="fa fa-pie-chart"></i> <span>দাউদকান্দি</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/laksam">
								<i class="fa fa-pie-chart"></i> <span>লাকসাম</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/brahmanpara">
								<i class="fa fa-pie-chart"></i> <span>ব্রাহ্মণপাড়া</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/burichong">
								<i class="fa fa-pie-chart"></i> <span>বুড়িচং</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/chauddagram">
								<i class="fa fa-pie-chart"></i> <span>চৌদ্দগ্রাম</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/debidwar">
								<i class="fa fa-pie-chart"></i> <span>দেবীদ্বার</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/homna">
								<i class="fa fa-pie-chart"></i> <span>হোমনা</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/muradnagar">
								<i class="fa fa-pie-chart"></i> <span> মুরাদনগর</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/nangalkot">
								<i class="fa fa-pie-chart"></i> <span>লাঙ্গলকোট</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/meghna">
								<i class="fa fa-pie-chart"></i> <span>মেঘনা</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/titas">
								<i class="fa fa-pie-chart"></i> <span>তিতাস</span> 
							  </a>			 
							</li>
							<li class="treeview">
							  <a href="http://adcrevenue.com/web/monohorgonj">
								<i class="fa fa-pie-chart"></i> <span>মনোহরগঞ্জ</span> 
							  </a>			 
							</li>				
						</div>			
					  </div>
					</div>
				<?php } ?>				
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $this->title ?>
                    <?php if (isset($this->params['subtitle'])): ?>
                        <small><?php echo $this->params['subtitle'] ?></small>
                    <?php endif; ?>
                </h1>

                <?php echo Breadcrumbs::widget([
                    'tag'=>'ol',
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <?php if (Yii::$app->session->hasFlash('alert')):?>
                    <?php echo \yii\bootstrap\Alert::widget([
                        'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                        'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                    ])?>
                <?php endif; ?>
                <?php echo $content ?>
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
<footer class="footer" style="background:#bf4939; padding-bottom:10px; padding-top:20px;">
    <div class="container">
        <p class="pull-left">&copy; দেওয়ানী ও সার্ভে ট্রাইব্যুনাল মামলার মনিটরিং সিষ্টেম, ২০১৬ - ভার্সন: ১.০ সর্বস্বত্ব সংরক্ষিত ।</p>
        <p class="pull-right"><font color="white">টেকনিকেল সাপোর্ট&nbsp;<a href="http://schooloffreelancing.com/" target="_blank" style="color:#b2ca4b;">স্কুল অফ ফ্রীল্যানসিং&nbsp;</a>এবং &nbsp;<a href="http://www.ltb.com.bd" target="_blank" style="color:#b2ca4b;">এলটিবি</a></font></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>