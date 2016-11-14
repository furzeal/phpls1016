<?php
getImages();
function getImages()
{
    echo "<ul> Список файлов:</ul>";
    $dir = scandir('../photos');
    foreach ($dir as $item) {
        if (($item !== ".") && ($item !== "..")) {
            echo "<li>" . $item .
                "<div>
                <a href='rename_file.php?name={$item}'>Переименовать</a>
                <a href='delete_file.php?name={$item}'>Удалить</a>
            </li>";
        }
    }
    echo "</ul>";
}

