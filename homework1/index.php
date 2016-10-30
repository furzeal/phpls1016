<?php
// Header
echo '<h2>PHP course loftschool. Домашнее задание #1. Максим Шаталов</h2><br/>';

// Task #1
echo '<h3>Задание #1</h3>';
$name = 'Maxim';
$age = '34';
echo "Меня зовут $name<br/>";
echo "Мне $age года<br/>";
echo "\"!|\\/'\"\\<br/><br/>";

// Task #2
echo '<h3>Задание #2</h3>';
$total = 80;
$feltTipPen = 23;
$pencil = 40;
$paint = $total - $feltTipPen - $pencil;
echo "$paint рисунков были нарисованы красками<br/><br/>";

// Task #3
echo '<h3>Задание #3</h3>';
define("G", 9.81);
if (defined("G")) {
    echo "Константа G объявлена<br/>";
    echo "G = " . G;
    echo "<br/><br/>";
}

// Task #4
echo '<h3>Задание #4</h3>';
$age = 19;
echo "Ваш возраст: $age<br/>";
if (($age >= 18) && ($age <= 65)) {
    echo "Вам еще работать и работать<br/>";
} elseif ($age > 65) {
    echo "Вам пора на пенсию<br/>";
} elseif (($age >= 1) && ($age <= 17)) {
    echo "Вам еще рано работать<br/>";
} else {
    echo "Неизвестный возраст<br/>";
}
echo "<br/>";

// Task #5
echo '<h3>Задание #5</h3>';
$day = 4;
switch ($day) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo "Это рабочий день<br/>";
        break;
    case 6:
    case 7:
        echo "Это выходной день<br/>";
        break;
    default:
        echo "Неизвестный день<br/>";
        break;
}
echo "<br/>";

// Task #6
echo '<h3>Задание #6</h3>';
$bmw = [
    "model" => "X5",
    "speed" => 120,
    "doors" => 5,
    "year" => "2015"
];
$toyota = [
    "model" => "Rav4",
    "speed" => 110,
    "doors" => 5,
    "year" => "2013"
];
$opel = [
    "model" => "Corsa",
    "speed" => 95,
    "doors" => 3,
    "year" => "2010"
];
$cars = [
    "bmw" => $bmw,
    "toyota" => $toyota,
    "opel" => $opel
];
foreach ($cars as $car => $value) {
    echo "Car {$car}<br/>";
    echo "{$value["model"]} " .
        "{$value["speed"]} " .
        "{$value["doors"]} " .
        "{$value["year"]}";
    echo "<br/>";
}
echo "<br/>";

// Task #7
echo '<h3>Задание #7</h3>';
$result;
for ($x = 1; $x <= 10; $x++) {
    for ($y = 1; $y <= 10; $y++) {
        $result = $x * $y;
        if (($x % 2 == 0) && ($y % 2 == 0)) {
            echo "($result) ";
        } elseif (($x % 2 == 1) && ($y % 2 == 1)) {
            echo "[$result] ";
        } else {
            echo "$result ";
        }

    }
    echo "<br/>";
}
echo "<br/>";


// Task #8
echo '<h3>Задание #8</h3>';
$str = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, eaque.";
echo "$str</br>";
$strings = explode(" ", $str);
//var_dump($strings);
$i = 0;
$word = $strings[$i];
if (isset($word)) {
    $str = $word;
}
while (isset($word)) {
    $str .= "—" . $word;
    $i++;
    $word = $strings[$i];
}
echo "$str</br>";
