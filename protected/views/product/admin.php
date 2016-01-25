<?php
$this->breadcrumbs = array (
    'Products' => array (
        'list' 
    ),
    'Manage' 
);

$this->menu = array (
    array (
        'label' => 'Create Product',
        'url' => array (
            'create' 
        ) 
    ) 
);

?>

<h1>Manage Products</h1>

<?php

$this->widget ( 'bootstrap.widgets.TbGridView', array (
    'id' => 'product-grid',
    'dataProvider' => $model->search (),
    'filter' => $model,
    'columns' => array (
        'id',
        array (
            'name' => 'name',
            'type' => 'html',
            'value' => '$data->nameTag' 
        ),
        array (
            'name' => 'description',
            'type' => 'html',
            'value' => 'nl2br(htmlentities($data->description))' 
        ),
        'timestamp',
        array (
            'name' => 'image',
            'type' => 'html',
            'value' => '$data->getImageTag(100)',
            'filter' => false 
        ),
        array (
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'buttons' => array (
                'update' => array (
                    'url' => '$data->ProductEditUrl' 
                ) 
            ) 
        ) 
    ) 
) );
?>
