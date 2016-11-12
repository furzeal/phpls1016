<?php
// Не принято: 8
// Header
echo '<h2>PHP course loftschool. Домашнее задание #2. Максим Шаталов</h2><br/>';

// Task #1
// Принято
//
// Замечание: Если в передаваемом массиве больше 1-2-3 элементов, желательно объявлять его
// до передачи в какую-либо функцию. Удобнее для чтения кода и отлова ошибок
echo '<h3>Задание #1</h3>';
function func1($strArr, $isReturnable = false)
{
    foreach ($strArr as $key => $value) {
        echo "<p>$value</p>";
    }
    if ($isReturnable) {
        $wholeString = implode($strArr);
        return $wholeString;
    }
}

$arr = ["Lorem", "ipsum", "dolor", "sit", "amet."];
$result = func1($arr, true);
if (isset($result)) {
    echo $result;
}
echo '</br>';

// Task #2
// Принято
//
// Замечание, визуальная оптимизация заключается в вынесении foreach за пределы switch,
// в таком случае значительно сокращается уменьшается количество кода, а воспринимается и редактируется проще.
// Минус такого варианта: проверка условия на каждом круге цикла. Если речь о тяжелых вычислениях
// или сложных условиях, по быстродействию текущий вариант корректнее
echo '<h3>Задание #2</h3>';
function func2($numbers, $action)
{
    // Check whether array is numeric
    foreach ($numbers as $key => $value) {
        if (!(is_float($value) || is_int($value))) {
            return "Массив должен содержать только числовые значения!";
        }
    }
    // Get count of array members
    $count = count($numbers);
    if ($count == 1) {
        return $numbers[0];
    } else {
        // Calc expression
        $result = $numbers[0];
        switch ($action) {
            case "+":
                for ($i = 1; $i < $count; $i++) {
                    $result += $numbers[$i];
                }
                break;
            case "-":
                for ($i = 1; $i < $count; $i++) {
                    $result -= $numbers[$i];
                }
                break;
            case "*":
                for ($i = 1; $i < $count; $i++) {
                    $result *= $numbers[$i];
                }
                break;
            case "/":
                for ($i = 1; $i < $count; $i++) {
                    $result /= $numbers[$i];
                }
                break;
            default:
                // return error message
                return "$action — Неверный знак арифметической операции";
        }
        return $result;
    }
}

echo func2([1.5, 432], "-");
echo '</br></br>';

// Task #3
// Принято
//
// Замечание: слишком много return. В большой функции такое количество возвратов может негативно сказаться на отладке
echo '<h3>Задание #3</h3>';
function func3()
{
    // Check whether function has 2 parameters minimun
    $count = func_num_args();
    $errorMsg = "";
    if ($count < 2) {
        $errorMsg = "Функция должна иметь минимум 2 параметра";
    }
    // Get array of numbers
    $numbers[] = func_get_arg(1);
    for ($i = 2; $i < $count; $i++) {
        $numbers[] = func_get_arg($i);
    }
    // Check whether the array is numeric
    foreach ($numbers as $key => $value) {
        if (!(is_float($value) || is_int($value))) {
            $errorMsg = "Массив должен содержать только числовые значения!";
        }
    }
    // Get arithmetic sign
    $actionSign = func_get_arg(0);
    if (!is_string($actionSign)) {
        $errorMsg = "Первый параметр должен быть строкой";
    }
    // Check errors
    if ($errorMsg !== "") {
        return $errorMsg;
    }
    // Get count of array members
    $count = count($numbers);
    $result = $numbers[0];
    if ($count !== 1) {
        // Calc expression
        $result = $numbers[0];
        switch ($actionSign) {
            case "+":
                for ($i = 1; $i < $count; $i++) {
                    $result += $numbers[$i];
                }
                break;
            case "-":
                for ($i = 1; $i < $count; $i++) {
                    $result -= $numbers[$i];
                }
                break;
            case "*":
                for ($i = 1; $i < $count; $i++) {
                    $result *= $numbers[$i];
                }
                break;
            case "/":
                for ($i = 1; $i < $count; $i++) {
                    $result /= $numbers[$i];
                }
                break;
            default:
                // return error message
                return "$actionSign — Неверный знак арифметической операции";
        }
    }
    return $result;
}

echo func3("+", 3, 3);
echo '</br></br>';

// Task #4
// Принято
echo '<h3>Задание #4</h3>';
function func4($number1, $number2)
{
    if (is_int($number1) && is_int($number2)) {
        for ($x = 1; $x <= $number1; $x++) {
            for ($y = 1; $y <= $number2; $y++) {
                $result = $x * $y;
                echo "$result ";
            }
            echo "<br/>";
        }
    } else {
        return "Числа не являются целыми";
    }
}

echo func4(10, 15);
echo '</br>';

// Task #5
// Принято
//
// Обязательное доп. задание: проверить работу функции для строки "ААббАА"
echo '<h3>Задание #5</h3>';
// Define isPalindrome function
function isPalindrome($word)
{
    $str = $word;
    // Remove white spaces from string
    // Бессмысленная замена двойных пробелов, если ниже все одиночные пробелы заменяются
    $str = str_replace("  ", "", $str);
    $str = str_replace(" ", "", $str);
    // Set string to uppercase
    $str = strtoupper($str);
    // Compare string with mirror
    if ($str == utf8_strrev($str)) {
        return true;
    } else {
        return false;
    }
}

// support function
function str_to_array($string)
{
    $length = mb_strlen($string);
    $ret = [];

    for ($i = 0; $i < $length; $i += 1) {

        $ret[] = mb_substr($string, $i, 1);
    }

    return $ret;
}

// support function
function utf8_strrev($string)
{
    return implode(array_reverse(str_to_array($string)));
}

// Define func5
function func5()
{
    //$word = "  oLo lO  ";
    $word = "ААббАА";
    if (isPalindrome($word)) {
        echo "Строка \"$word\" является палиндромом без учета пробелов и регистра";
    } else {
        echo "Строка \"$word\" не является палиндромом без учета пробелов и регистра";
    }
}

func5();
echo '</br></br>';

// Task #6
// Принято
echo '<h3>Задание #6</h3>';
$result = date("d.m.Y H:i");
echo "$result<br/>";
$result = mktime(0, 0, 0, 2, 24, 2016);
echo "$result<br/>";
echo '</br>';


// Task #7
// Принято
echo '<h3>Задание #7</h3>';
$statement = "Карл у Клары украл Кораллы";
echo "Исходная строка: $statement<br/>";
$statement = str_replace("К", "", $statement);
echo "Результат: $statement<br/>";
$statement = "Две бутылки лимонада";
echo "Исходная строка: $statement<br/>";
$statement = str_replace("Две", "Три", $statement);
echo "Результат: $statement<br/>";
echo '</br>';

// Task #8
echo '<h3>Задание #8</h3>';
// Не принято.
// Для значения 9801 отображается сообщение "Сеть отсутствует"
// Run function
PacketsCount("RX packets:981 errors:0 dropped:0 overruns:0 frame:)0. ");
// Count packets
function PacketsCount($string)
{
    preg_match("/packets:[0-9]*/", $string, $packetsCount);
    $packetsCount = preg_replace("/packets:/", "", $packetsCount);
    $packetsCount=(int)$packetsCount[0];
    if ($packetsCount >= 1000) {
        $isSmileExist = preg_match("/:\\)/", $string);
        if ($isSmileExist) {
            drawSmile();
        } else {
            echo "Сеть есть";
        }
    } else {
        echo "Сеть отсутствует";
    }
}

// Smile
function drawSmile()
{
    Echo "<Pre style=\"line-height:.6\">$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$'               `$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$\n
$$$$$$$$$$$$$$$$$$$$$$$$$$$$'                   `$$$$$$$$$$$$$$$$$$$$$$$$$$$$\n
$$$'`$$$$$$$$$$$$$'`$$$$$$!                       !$$$$$$'`$$$$$$$$$$$$$'`$$$\n
$$$$  $$$$$$$$$$$  $$$$$$$                         $$$$$$$  $$$$$$$$$$$  $$$$\n
$$$$. `$' \' \$`  $$$$$$$!                         !$$$$$$$  '$/ `/ `$' .$$$$$\n
$$$$$. !\  i  i .$$$$$$$$                           $$$$$$$$. i  i  /! .$$$$$\n
$$$$$$   `--`--.$$$$$$$$$                           $$$$$$$$$.--'--'   $$$$$$\n
$$$$$\$L        `$$$$$^^$$                           $$^^$$$$$'        J$$$$$$\n
$$$$$$$.   .'   \"\"~   $$$    $.                 .$  $$$   ~\"\"   `.   .$$$$$$$\n
$$$$$$$$.  ;      .e$$$$$!    $$.             .$$  !$$$$\$e,      ;  .$$$$$$$$\n
$$$$$$$$$   `.$$$$$$$$$$$$     $$$.         .$$$   $$$$$$$$$$$$.'   $$$$$$$$$\n
$$$$$$$$    .$$$$$$$$$$$$$!     $$`$$$$$$$$'$$    !$$$$$$$$$$$$$.    $$$$$$$$\n
$$$$$$$     $$$$$$$$$$$$$$$$.    $    $$    $   .$$$$$$$$$$$$$$$$     $$$$$$$\n
                                 $    $$    $\n
                                 $.   $$   .$\n
                                 `$        $'\n
                                  `$$$$$$$$'<Pre>";
}

echo '</br></br>';

// Task #9
// Принято
echo '<h3>Задание #9</h3>';
function func9($filename)
{
    return file_get_contents($filename);
}

echo func9("Test.txt");
//echo '</br></br>';

// Task #10
// Принято
file_put_contents("anothertest.txt", "Hello again!");
//echo '</br></br>';

