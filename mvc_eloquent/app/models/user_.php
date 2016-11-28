<?php


class User_ extends Model
{
    public $name;
    public $age;
    public $description;
    public $avatar;
    public $photos;
    public $ageType;

    public function __construct()
    {
        parent::__construct();

    }

    public function getData($id)
    {
        $this->getProperties($id);
        $this->getPhotos($id);
    }

    private function getProperties($id)
    {

        try {
            $sql = "SELECT name, age, description
                        FROM users
                        WHERE id = :id";
            $STH = parent::$DBH->prepare($sql);
            $STH->execute([':id' => $id]);
            $row = $STH->fetch();
            if ($row) {
                $this->name = $row['name'];
                $this->age = $row['age'];
                if ($this->age < 18) {
                    $this->ageType = 'несовершеннолетний';
                } else {
                    $this->ageType = 'совершеннолетний';
                }
                $this->description = $row['description'];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPhotos($id)
    {
        try {
            $sql = "SELECT filename
                        FROM photos
                        WHERE id_user = :id";
            $STH = parent::$DBH->prepare($sql);
            $STH->execute([':id' => $id]);
            $row = $STH->fetchAll();
            if ($row) {
                $this->avatar = $row[0]['filename'];
                $this->photos = $row;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}