<?php


class Registration extends Controller
{
    public function index()
    {
        if ($this->recaptchaCheck()) {
            // Get data
            $data = $this->getData();
            $file = empty($_FILES['photo']) ? null : $_FILES['photo'];
            // Check data in model
            if (isset($_POST['login'])) {
                $model = $this->model('model_registration');
                // Check user
                if ($model->checkUser($data['login'])) {
                    // Check file
                    if ($file['error'] === UPLOAD_ERR_OK) {
                        if ($model->checkFile($file)) {
                            $id = $model->insertUser($data);
                            $model->insertFile($id, $file);
                            // Send email
                            $mailer = new Mailer();
                            $mailer->sendMail($data['email'], $data['name']);
                            header('Location: home');
                            exit();
                        } else {
                            echo "Файл не является картинкой";
                        }
                    } else {
                        $model->insertUser($data);
                        // Send email
                        $mailer = new Mailer();
                        $mailer->sendMail($data['email'], $data['name']);
                        header('Location: home');
                        exit();
                    }
                } else {
                    echo "Такой пользователь уже существует";
                }
            }
        } else {
          echo "Вы точно не робот?";
        }
        $this->view('registration');
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

}