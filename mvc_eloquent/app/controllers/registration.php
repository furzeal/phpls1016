<?php

class Registration extends Controller
{
    public function index()
    {
        if ($this->recaptchaCheck()) {
            // Get data
            $data = $this->getData();
            // Check data in model
            if (isset($_POST['login'])) {
                // Check user
                if ($this->checkUser($data['login'])) {
                    // Check file
                    $file = empty($_FILES['photo']) ? null : $_FILES['photo'];
                    $this->checkFile($file, $data);
                } else {
                    echo "Такой пользователь уже существует";
                }
            }
        } else {
            echo "Вы точно не робот?";
        }
        $this->view('registration');
    }

    private function recaptchaCheck()
    {
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $gRecaptchaResponse = $_POST['g-recaptcha-response'];
        $recaptcha = new \ReCaptcha\ReCaptcha("6LeF-AwUAAAAAMImd6gKxDkHx-lev6OZOe2IXiMs");
        $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
        if ($resp->isSuccess()) {
            return true;
        } else {
            return false;
        }
    }

    private function getData()
    {
        $name = htmlentities(strip_tags(trim($_POST['name'])), ENT_QUOTES);
        $age = (int)($_POST['age']);
        $description = htmlentities(strip_tags(trim($_POST['description'])), ENT_QUOTES);
        $login = htmlentities(strip_tags(trim($_POST['login'])), ENT_QUOTES);
        $password = htmlentities(strip_tags(trim($_POST['password'])), ENT_QUOTES);
        $email = htmlentities(strip_tags(trim($_POST['email'])), ENT_QUOTES);
        return ['name' => $name,
            'age' => $age,
            'description' => $description,
            'login' => $login,
            'password' => $password,
            'email' => $email];
    }

    public function checkUser($login)
    {
        $users = \Models\User::where('login', '=', $login)->get();
        if (!empty($users->toArray())) {
            // User exists
            return false;
        } else {
            return true;
        }
    }

    private function checkFile($file, $data)
    {
        if ($file['error'] === UPLOAD_ERR_OK) {
            if (preg_match('/(jpeg|jpg|png|gif)/', $file['name'])
                && preg_match('/(jpeg|jpg|png|gif)/', $file['type'])
            ) {
                $id = $this->insertUser($data);
                $this->insertFile($id, $file);
                // Send email
                $mailer = new Mailer();
                $mailer->sendMail($data['email'], $data['name']);
                header('Location:' . App::$host . 'home');
                exit();
            } else {
                echo "Файл не является картинкой";
            }
        } else {
            $this->insertUser($data);
            // Send email
            $mailer = new Mailer();
            $mailer->sendMail($data['email'], $data['name']);
            header('Location:' . App::$host . 'home');
            exit();
        }
    }

    private function insertUser($data)
    {
        try {
            // Insert user
            $user = new Models\User();
            $user->name = $data['name'];
            $user->age = $data['age'];
            $user->description = $data['description'];
            $user->login = $data['login'];
            $user->password = $data['password'];
            $user->email = $data['email'];
            $user->save();
            $id = $user->id;
            // Return id of user
            Session::init();
            Session::set('loggedIn', true);
            Session::set('id', $id);
            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function insertFile($id, $file)
    {
        try {
            $filename = self::makeFilename($id, $file);
            move_uploaded_file($file['tmp_name'], App::$baseDir . '/photos/' . $filename);
            $photo = new Models\Photo();
            $photo->filename = $filename;
            $photo->id_user = $id;
            $photo->save();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private static function makeFilename($id, $file)
    {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $result = $id . "_avatar.$ext";
        return $result;
    }
}