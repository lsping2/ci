<?php
if(! defined('BASEPATH')) exit('No direct script access allowed'); 
//직접적으로 스크립트를 실행할 수 없게 하는 로직

if(! function_exists('alert')){  //kdate라는 함수가 없다면
  function alert($msg){
    echo "<script>alert('$msg');</script>";

  }
}

?>