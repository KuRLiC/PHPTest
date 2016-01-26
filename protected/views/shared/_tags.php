<?php

// se sono già nella pagina di ricerca rimango nella pagina di ricerca
$stayHere = (yii_route () == 'product/list');

$stats = array ();
foreach ( Tag::getAll () as $tag )
{
  $cnt = $tag->productsCount;
  if ($cnt > 0)
  {
    $statItem = array (
        'weight' => $cnt,
        'url' => url ( 'product/list', array (
            'tag' => $tag->name 
        ) ) 
    );
    if ($stayHere)
      $statItem ['htmlOptions'] = array (
          'target' => '_self' 
      );
    $stats [$tag->name] = $statItem;
  }
}

if (count ( $stats ) > 0)
{
  $this->widget ( 'application.extensions.yii-tagcloud.YiiTagCloud', array (
      'beginColor' => '00089A',
      'endColor' => 'A3AEFF',
      'minFontSize' => 8,
      'maxFontSize' => 20,
      'arrTags' => $stats 
  ) );
}