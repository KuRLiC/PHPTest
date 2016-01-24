<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5')); ?><br/>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5')); ?><br/>

	<?php echo $form->textFieldRow($model,'timestamp',array('class'=>'span5', 'readonly'=>'readonly')); ?><br/>

	<?php echo $form->fileFieldRow($model,'image',array('class'=>'span5', 'readonly'=>'readonly')); ?><br/>
	
	<?php
	if(!$model->isNewRecord && $model->imageExists)
	{
		echo($model->imageTag);
	}
	?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
