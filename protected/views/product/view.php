<?php
/**
 * @var ProductController $this
 * @var Product $model
 */
$this->breadcrumbs = array (
    'Products' => array (
        'list' 
    ),
    $model->name 
);

$this->menu = array (
    array (
        'label' => 'Create Product',
        'url' => array (
            'create' 
        ) 
    ),
    array (
        'label' => 'Edit Product',
        'url' => array (
            'edit',
            'id' => $model->id 
        ) 
    ),
    array (
        'label' => 'Delete Product',
        'url' => '#',
        'linkOptions' => array (
            'submit' => array (
                'delete',
                'id' => $model->id 
            ),
            'confirm' => 'Are you sure you want to delete this item?' 
        ) 
    ),
    array (
        'label' => 'List Product',
        'url' => array (
            'list' 
        ) 
    ) 
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php

$this->widget ( 'bootstrap.widgets.TbDetailView', array (
    'data' => $model,
    'attributes' => array (
        'id',
        'name',
        'description',
        'timestamp' 
    ) 
)
// 'image',

 );

if (! $model->isNewRecord && $model->imageExists)
{
  echo ($model->imageTag);
}
?>
