<?php

/**
@return CWebApplication
*/
function yii_app()
{
	return Yii::app();
}

function url($route, array $params = array())
{
	return yii_app()->createUrl($route, $params);
}