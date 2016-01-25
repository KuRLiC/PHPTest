<?php
/**
 * @var ProductController $this
 * @var Product $model
 */
$this->breadcrumbs = array (
    'Products' => array (
        'list' 
    ),
    'Create' 
);

$this->menu = array (
    array (
        'label' => 'List Product',
        'url' => array (
            'list' 
        ) 
    ) 
);
?>

<h1>Create Product</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>