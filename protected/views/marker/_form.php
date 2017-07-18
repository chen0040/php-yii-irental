<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'marker-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'data_type'); ?>
		<?php echo $form->textField($model,'data_type'); ?>
		<?php echo $form->error($model,'data_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'age'); ?>
		<?php echo $form->textField($model,'age'); ?>
		<?php echo $form->error($model,'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'image_link1'); ?>
		<?php echo $form->textField($model,'image_link1'); ?>
		<?php echo $form->error($model,'image_link1'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'image_link2'); ?>
		<?php echo $form->textField($model,'image_link2'); ?>
		<?php echo $form->error($model,'image_link2'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'image_link3'); ?>
		<?php echo $form->textField($model,'image_link3'); ?>
		<?php echo $form->error($model,'image_link3'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'image_link4'); ?>
		<?php echo $form->textField($model,'image_link4'); ?>
		<?php echo $form->error($model,'image_link4'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'video_link'); ?>
		<?php echo $form->textField($model,'video_link'); ?>
		<?php echo $form->error($model,'video_link'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'is_available'); ?>
		<?php echo $form->textField($model,'is_available'); ?>
		<?php echo $form->error($model,'is_available'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->