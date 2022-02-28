<?php
if(! defined('BASEPATH')) exit('No direct script access allowed'); 
//직접적으로 스크립트를 실행할 수 없게 하는 로직

if(! function_exists('url')){  
  function url($url){
    echo "<script>location.href='$url'</script>";

  }
}


if(! function_exists('redirect')){  
  function redirect($url){
    echo "<script>location.href='$url'</script>";

  }
}
?>