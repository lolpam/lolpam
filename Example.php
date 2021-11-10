<?php
$TOKEN = '2136648431:AAHXsTzbGPsyriY5TMHnSb0HERZ1Z7MwPEg'; //ваше токен, получен в BotFather
$BOT_USERNAME = 'Example_s_bot'; // юзернейм бота (без собачки)
$webhook =  'https://sellpd.000webhostapp.com/bax_100.php'; //ваша ссылка

$url = 'https://api.telegram.org/bot'.$TOKEN.'/';


if (($json = valid()) == false) { echo get($url.'setWebhook?url='.$webhook); exit();}
 
$uid = $json['message']['from']['id'];
$first_name = $json['message']['from']['first_name'];
$ANSWER = "Ну привет, ".$first_name;
sendMessage($uid,$ANSWER);

$text = $json['message']['text'];

switch($text){

 case '1':
   $ANSWER = "Ти відправив одиницю";
 break;

 case 'скажіть пароль':
   $ANSWER = 'jjcom';
 break;

 case 'Допобачення':
    $ANSWER = "Допобачення";
 break;
}

function valid() {
	$request_from_telegram = false;
	if(isset($_POST)) {
		$data = file_get_contents("php://input");
		if (json_decode($data) != null)
			$request_from_telegram = json_decode($data,1);
	}
	return $request_from_telegram;
}


function sendMessage($chat_id,$text,$markup=null)
{
	return get($GLOBALS['url'].'sendMessage?chat_id='.$chat_id.'&text='.urlencode($text).'&reply_markup='.$markup.'&parse_mode=Markdown');
}

function get($url)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

?>
