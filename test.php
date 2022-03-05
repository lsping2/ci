<?
echo $this->input->ip_address();;
$url ="api.openweathermap.org/data/2.5/weather?q=Seoul&appid=44751ea6b405b0807b2e96f87991691a";
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





