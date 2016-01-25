<?php

/**
 * @var ProductController $this
 * @var Product $model
 * @var TbActiveForm $form
 */
$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
    'id' => 'product-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array (
        'enctype' => 'multipart/form-data' 
    ) 
) );
?>

<p class="help-block">
  Fields with <span class="required">*</span> are required.
</p>
<?php
echo $form->errorSummary ( $model );

echo $form->textFieldRow ( $model, 'name', array (
    'class' => 'span5' 
) );
echo "<br />";

echo $form->textAreaRow ( $model, 'description', array (
    'class' => 'span5' 
) );
echo "<br />";

echo $form->textFieldRow ( $model, 'timestamp', array (
    'class' => 'span5',
    'readonly' => 'readonly' 
) );
echo "<br />";

echo $form->fileFieldRow ( $model, 'image', array (
    'class' => 'span5',
    'readonly' => 'readonly' 
) );
echo "<br />";
echo "<br />";

echo CHtml::label ( 'Tags', 'tagsArray' );
$this->widget ( 'ext.yii-selectize.YiiSelectize', array (
    'id' => 'tagsArray',
    'name' => 'tagsArray',
    'value' => '',
    'data' => Tag::getAllArrayNames (),
    'selectedValues' => $model->tagsArray,
    'fullWidth' => true,
    'multiple' => true 
) );

if (! $model->isNewRecord && $model->imageExists)
{
  echo ($model->imageTag);
}
?>

<div class="form-actions">
		<?php
  
  $this->widget ( 'bootstrap.widgets.TbButton', array (
      'buttonType' => 'submit',
      'type' => 'primary',
      'label' => $model->isNewRecord ? 'Create' : 'Save' 
  ) );
  ?>
	</div>

<?php $this->endWidget(); ?>
