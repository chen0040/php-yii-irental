<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<?php if(!Yii::app()->user->isGuest):?> 
<p>
You last logged in on <?php echo date( 'l, F d, Y, g:i a', Yii::app()->user->lastLoginTime ); ?>. 
</p> 
<?php else: ?>
<p>
You can <?php echo CHtml::link(CHtml::encode('login'), array('/site/login')); ?> to administrator your activity. If you are not a member, please <?php echo CHtml::link(CHtml::encode('sign up'), array('user/create')); ?> to get a free membership account 
</p>
<?php endif;?>


<ul>
<li><?php echo CHtml::link(CHtml::encode('Sign up'), array('user/create')); ?></li>
<li><?php echo CHtml::link(CHtml::encode('Check out Rental Services'), array('marker/index')); ?></li>

</ul>



 
<!--
<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
-->