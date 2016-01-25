<?php
/**
 * @var ProductController $this
 * @var Product $model
 */
$this->breadcrumbs = array (
    'Products' => array (
        'list' 
    ),
    $model->name => array (
        'view',
        'id' => $model->id 
    ),
    'Edit' 
);

$this->menu = array (
    array (
        'label' => 'Create Product',
        'url' => array (
            'create' 
        ) 
    ),
    array (
        'label' => 'View Product',
        'url' => array (
            'view',
            'id' => $model->id 
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

<h1>Edit Product <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>