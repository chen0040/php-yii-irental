<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row"> 
		<?php echo $form->label($model,'password_repeat'); ?> 
		<?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>256)); ?> 
		<?php echo $form->error($model,'password_repeat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addressline1'); ?>
		<?php echo $form->textField($model,'addressline1',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'addressline1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addressline2'); ?>
		<?php echo $form->textField($model,'addressline2',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'addressline2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addressline3'); ?>
		<?php echo $form->textField($model,'addressline3',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'addressline3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addressline4'); ?>
		<?php echo $form->textField($model,'addressline4',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'addressline4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->