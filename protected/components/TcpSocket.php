<?php

/**
 * Base class to manage TCP socket connections
 * @see http://php.net/manual/en/sockets.examples.php
 * @author p6
 */
class TcpSocket
{
  protected $socket;

  public function __construct()
  {
    if (($this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false)
      $this->throwError('socket_create');
  }
  
  protected function throwError($function, $msg=null)
  {
    throw new CException("$function() failed: reason: " . socket_strerror(socket_last_error($this->socket)) . ". $msg");
  }

  public function close()
  {
    socket_close($this->socket);
    $this->socket = null;
  }
  
  function __destruct()
  {
    $this->close();
  }
  
  public function write($bytes)
  {
    if(socket_write($this->socket, $bytes, strlen($bytes)) === false)
      $this->throwError("socket_write");
  }
  
  public function read($size=4096)
  {
    return socket_read($this->socket, $size);
  }
}
