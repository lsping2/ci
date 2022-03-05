<?
//$url ="api.openweathermap.org/data/2.5/weather?q=Seoul&appid=44751ea6b405b0807b2e96f87991691a";

$ip_addr =  $this->input->ip_address();
$ip_addr="222.111.52.15";
$geoplugin = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip_addr) );
if ( is_numeric($geoplugin['geoplugin_latitude']) && is_numeric($geoplugin['geoplugin_longitude']) ) {
    $lat = $geoplugin['geoplugin_latitude'];
    $lon = $geoplugin['geoplugin_longitude'];
}

$url ="api.openweathermap.org/data/2.5/weather?lat=".$lat."&lon=".$lon."&appid=44751ea6b405b0807b2e96f87991691a";

/*
if(extension_loaded("curl")){
    echo "ok";
}else{
    echo "no";
}
*/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); //TRUE 설정 시 curl_exec () 반환 값을 문자열로 반환
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
curl_setopt($ch, CURLOPT_COOKIE, '' );

$g = curl_exec($ch); //curl 실행
curl_close($ch); //curl 세션 닫기
$info = json_decode($g, true);
//print_r($info);
/*
echo "<Br><br>";
echo $info['weather'][0]['id'];
echo "<Br><br>";
echo $info['base'][0]['icon'];
*/
echo "<Br><br>";
?>

<?=$info['name']?> <img src="http://openweathermap.org/img/w/<?=$info['weather'][0]['icon']?>.png" style="height:40px;"> <?=$info['weather'][0]['main']?> (<?=$info['weather'][0]['description']?>)

<table class="table table-bordered table-sm mymargin5" style="width:60%">
    <tr>
      <th scope="col">회원등록</th>
      <th scope="col">등록건</th>
    </tr>
<? foreach($list as $row) { ?>
    <tr>
      <td><?=$row->subdate?></td>
      <td><?=$row->ct?></td>
    </tr>
<? } ?>
</table>