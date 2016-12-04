<?php
error_reporting(0);

require 'vk.php';
require 'post.php';

$token = file_get_contents('token.txt');
echo $token;
if (empty($token)) {
    $client_id = '5760279'; // ID приложения
    $client_secret = 's7STPZY1YqGe2tQOVyw6'; // Защищённый ключ
    $redirect_uri = 'blank.html'; // Адрес сайта

    $url = 'http://oauth.vk.com/authorize';

    $params = array(
        'client_id' => $client_id,
        'redirect_uri' => $redirect_uri,
        'response_type' => 'token',
        'display' => 'popup',
        'scope' => 'notify,friends,photos,offline,wall',
        'v' => 5.60
    );

    echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Загрузить картинку</a></p>';

    print_r($_GET['access_token']);
    if (isset($_GET['access_token'])) {
        file_put_contents('token.txt', $token);
    }
}
$user_id = '224269077';
$group_id = null;

$text = 'Тест vk api';
$image = __DIR__ . '/01.jpg';;

try {
    $vk = \vkApi\vk::create($token);
    $post = new \vkApi\post($vk, $user_id, $group_id);
    $post->post($text, $image);
    echo 'Success!';
} catch (Exception $e) {
    echo 'Error: <b>' . $e->getMessage() . '</b><br />';
    echo 'in file "' . $e->getFile() . '" on line ' . $e->getLine();

}



