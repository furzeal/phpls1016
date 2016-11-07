<?php
try {
    $DBH = new PDO("mysql:host=$host;dbname=$dbname",
        $user, $pass);
}