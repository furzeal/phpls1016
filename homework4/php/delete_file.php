<?php
require_once 'connect.php';
$filename=strip_tags($_GET['name']);
$filepath='../photos/'.$filename;
if (unlink($filepath)){
    // remove reference from DB
    $sql = "UPDATE users
            SET filename = NULL
            WHERE filename = :filename";
    $STH = $DBH->prepare($sql);
    $STH->execute([':filename' => $filename]);
}



header('HTTP/1.1 307 Temporary Redirect');
header('Location: homepage.php');