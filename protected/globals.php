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

function print_product_tag($tag, $echo = true)
{
  $style = "
    border-radius: 3px;
    cursor: pointer;
    margin: 3px 3px;
    padding: 2px 6px;
    background: #1da7ee;
    color: #ffffff;
    border: 1px solid #0073bb;
  ";
  $html = "<span style=\"{$style}\">{$tag}</span> ";
  if ($echo)
    echo $html;
  return $html;
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
