<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
)); ?>

<p>Questo è un progetto di prova per dimostrare la mia abilità nell'utilizzo di un frameworkk PHP che sfrutta il pattern MVC!</p>
<p>Io sono Paolo Treu, ho 30 anni, sono sposato e con un figlio appena nato.</p>
<p>Sono uno sviluppatore e amo il mio lavoro, amo debuggare e risolvere problemi.</p>
<p>Mi piace immergermi nelle nuove tecnologie ed mi piace sperimentare nuovi linguaggi.</p>
<p>I linguaggi da me utilizzati maggiormente sono:</p>
<ul>
<li>C++</li>
<li>C#</li>
<li>PHP</li>
<li>Javscript e Coffe Script</li>
<li>Html e Haml + CSS</li>
<li>Java</li>
</ul>
<p>Inoltre ho una istruzione di base su Python e Ruby</p>

<?php $this->endWidget(); ?>
