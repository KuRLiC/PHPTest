<?php

/**
 @return CWebApplication
 */
function yii_app()
{
  return Yii::app ();
}

function url($route, array $params = array())
{
  return yii_app ()->createUrl ( $route, $params );
}

function debug_log($line)
{
  $line = date ( "Y-m-d H:i:s" ) . " - " . $line . PHP_EOL;
  TcpClient::writeTo ( "127.0.0.1", 9999, $line );
}

function debug_obj($obj)
{
  return debug_log ( _2str ( $obj ) );
}

function debug_objs()
{
  return debug_obj ( func_get_args () );
}

/**
 * any var to string
 *
 * @param mixed $obj          
 * @param boolean $export
 *          (default true) true=php parsable, false=not parsable
 * @return string
 */
function _2str($obj, $export = true)
{
  if ($export)
    return var_export ( $obj, true );
  else
    return print_r ( $obj, true );
}
