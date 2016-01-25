<?php

class TcpClient extends TcpSocket
{
  public  function __construct($host, $port)
  {
    parent::__construct();
    $result = socket_connect($this->socket, $host, $port);
    if ($result === false) 
    {
      $this->throwError("socket_connect", "[RESULT: $result]");
    }    
  }
  
  public static function writeTo($host, $port, $text)
  {
    $client = new TcpClient($host, $port);
    $client->write($text);    
  }
}
