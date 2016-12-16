<?php

$attachment = __DIR__ . '/01.jpg';

$client_id = ''; // ID приложения
$client_secret = ''; // Защищённый ключ
$redirect_uri = 'http://php/08_vkapi/'; // Адрес сайта

$url = 'http://oauth.vk.com/authorize';

$params = array(
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code',
    'scope' => 'email,friends,photos,audio,video,pages,status,notes,wall,ads,docs,groups,notifications,market',
    'v' => 5.60
);

echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Загрузить картинку</a></p>';

if (isset($_GET['code'])) {
    $result = false;
    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri,
        'v' => 5.60
    );

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
    if (isset($token['access_token'])) {
        // Get Wall Upload Server url
        $params = array(
            'access_token' => $token['access_token'],
            'v' => 5.60
        );
        $photosServer = api("photos.getWallUploadServer", $params);
        $upload_url = $photosServer['response']['upload_url'];

        // Post request
        if (!empty($upload_url)) {
            $file = curl_file_create($attachment);
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $upload_url);
            curl_setopt($curl, CURLOPT_POST, 1);
            //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array('photo' => $file));
            //curl_setopt($curl, CURLOPT_POSTFIELDS, array('photo' => '@' . $attachment));
            $result = json_decode(curl_exec($curl), true);
            curl_close($curl);
        }
        if ($result) {
            $params = array(
                'server' => $result['server'],
                'photo' => $result['photo'],
                'hash' => $result['hash'],
                'v' => 5.60,
                'access_token' => $token['access_token']
            );
            $saveResult = api("photos.saveWallPhoto", $params);

            if (!empty($saveResult)) {
                echo '<pre>';
                //print_r($saveResult);
                //echo 'photo'.$saveResult['response']['owner_id'].$saveResult['response']['id'];
                $response=$saveResult['response'][0];
                //var_dump($response['owner_id']);
                $url= $response['photo_1280'];
                // Post to wall
                $params = array(
                    'attachments' => 'photo'.$response['owner_id'].'_'.$response['id'],
                    'v' => 5.60,
                    'access_token' => $token['access_token']
                );
                //print_r($params['attachments']);
                $saveResult = api("wall.post", $params);
                if (isset($saveResult['error'])){
                    echo "<img src='$url' ><br/>";
                    echo 'Недостаточно прав доступа для публикации фото на стене<br/>';
                    echo 'error code:'.$saveResult['error']['error_code'];
                    echo '<br/>';
                    echo 'error message:'.$saveResult['error']['error_msg'];
                }
            } else {
                echo 'Не удалось загрузить файл';
            }
        } else {
            echo 'Не удалось загрузить файл';
        }
    } else {
        echo 'Ошибка авторизации';
    }

}
function api($method, $params)
{
    //print_r("https://api.vk.com/method/" . $method . '?' . urldecode(http_build_query($params)));
    return json_decode(file_get_contents("https://api.vk.com/method/" . $method . '?' . urldecode(http_build_query($params))), true);
}

//        $params = array(
//            'owner_id'         => $token['user_id'],
//            'friends_only'     => 0,
//            'message'          => 'Тест vk API',
//            'access_token'     => $token['access_token']
//        );
//
//
//        $params = array(
//            'owner_id'         => $token['user_id'],
//            'friends_only'     => 0,
//            'message'          => 'Тест vk API',
//            'access_token'     => $token['access_token']
//        );
//        print_r('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params)));
//        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/wall.post' . '?' . urldecode(http_build_query($params))), true);
//        if (isset($userInfo['response'][0]['uid'])) {
//            $userInfo = $userInfo['response'][0];
//            $result = true;
//        }
//    }

//    if ($result) {
//        echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
//        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
//        echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
//        echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
//        echo "День Рождения: " . $userInfo['bdate'] . '<br />';
//        echo '<img src="' . $userInfo['photo_big'] . '" />';
//        echo "<br />";
//    }


//    if (isset($token['access_token'])) {
//        $params = array(
//            'uids'         => $token['user_id'],
//            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
//            'access_token' => $token['access_token']
//        );
//        print_r('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params)));
//        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
//        if (isset($userInfo['response'][0]['uid'])) {
//            $userInfo = $userInfo['response'][0];
//            $result = true;
//        }
//    }
//
//    if ($result) {
//        echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
//        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
//        echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
//        echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
//        echo "День Рождения: " . $userInfo['bdate'] . '<br />';
//        echo '<img src="' . $userInfo['photo_big'] . '" />'; echo "<br />";
//    }