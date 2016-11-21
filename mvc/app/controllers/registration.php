<?php


class Registration extends Controller
{
    public function index()
    {
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
                        $model->insertFile($id,$file);
                        header('Location:' . App::$host . 'mvc/public/home');
                        exit();
                    } else {
                        echo "Файл не является картинкой";
                    }
                } else {
                    $model->insertUser($data);
                    header('Location:' . App::$host . 'mvc/public/home');
                    exit();
                }
            } else {
                echo "Такой пользователь уже существует";
            }
        }
        $this->view('registration/index');
    }

    private function getData()
    {
        $name = htmlentities(strip_tags(trim($_POST['name'])), ENT_QUOTES);
        $age = (int)($_POST['age']);
        $description = htmlentities(strip_tags(trim($_POST['description'])), ENT_QUOTES);
        $login = htmlentities(strip_tags(trim($_POST['login'])), ENT_QUOTES);
        $password = htmlentities(strip_tags(trim($_POST['password'])), ENT_QUOTES);
        return ['name' => $name,
            'age' => $age,
            'description' => $description,
            'login' => $login,
            'password' => $password];
    }

}