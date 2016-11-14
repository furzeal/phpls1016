<?php
require_once 'connect.php';


if (isset($_POST['newname'])) {

    $newname = htmlentities(strip_tags(trim($_POST['newname'])), ENT_QUOTES);
    $oldname = htmlentities(strip_tags(trim($_POST['oldname'])), ENT_QUOTES);
    $oldpath = '../photos/' . $oldname;
    $ext = strtolower(pathinfo($oldpath, PATHINFO_EXTENSION));
    $pattern = "/.$ext/";
    if (!preg_match($pattern, $newname)) {
        $newname .= ".$ext";
    }
    $newpath = '../photos/' . $newname;
    //echo $oldname, $newname;
    if (rename($oldpath, $newpath)) {
        // rename reference from DB
        $sql = "UPDATE users
                SET filename = ?
                WHERE filename = ?";
        $data = [$newname, $oldname];
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
    }

    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: homepage.php');
}

?>
<html>
<body>
<form method='post'> <!--action="homepage.php" >-->
    <div>
        <label for="newname">Введите новое имя файла</label>
        <div><input type="text" name="newname" id="newname" value="<?php echo $_GET['name']; ?>"></div>
    </div>
    <div>
        <div><input type="hidden" name="oldname" id="oldname"
                    value="<?php echo $_GET['name']; ?>"></div>
    </div>
    <div>
        <input type="submit" value="Переименовать">
    </div>
</form>
</body>
</html>
