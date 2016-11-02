<?php
// Header
echo '<h2>PHP course loftschool. Домашнее задание #2. Максим Шаталов</h2><br/>';

// Task #1
echo '<h3>Задание #1</h3>';
function func1($strArr, $isReturnable = false)
{
    foreach ($strArr as $key => $value) {
        echo "<p>$value</p>";
    }
    if ($isReturnable) {
        $wholeString = "";
        foreach ($strArr as $key => $value) {
            $wholeString .= $value;
        }
        return $wholeString;
    }
}

$result = func1(["Lorem", "ipsum", "dolor", "sit", "amet."]);
if (isset($result)) echo $result;
echo '</br>';

// Task #2
echo '<h3>Задание #2</h3>';
function func2($numbers, $action)
{
    // Check whether array is numeric
    foreach ($numbers as $key => $value) {
        if (!(is_float($value) || is_int($value)))
            return "Массив должен содержать только числовые значения!";
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
echo '<h3>Задание #3</h3>';
function func3()
{
    // Check whether function has minimun 2 parameters
    $count = func_num_args();
    if ($count < 2) return "Функция должна иметь минимум 2 параметра";
    // Get array of numbers
    $numbers[] = func_get_arg(1);
    for ($i = 2; $i < $count; $i++) {
        $numbers[] = func_get_arg($i);
    }
    // Check whether the array is numeric
    foreach ($numbers as $key => $value) {
        if (!(is_float($value) || is_int($value)))
            return "Массив должен содержать только числовые значения!";
    }
    // Get arithmetic sign
    $actionSign = func_get_arg(0);
    if (!is_string($actionSign))
        return "Первый параметр должен быть строкой";
    // Get count of array members
    $count = count($numbers);
    if ($count == 1) {
        return $numbers[0];
    } else {
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
        return $result;
    }
}

echo func3("+", 3, 3);
echo '</br></br>';

// Task #4
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
echo '<h3>Задание #5</h3>';
// Define isPalindrome function
function isPalindrome($word)
{
    $str = $word;
    // Remove white spaces from string
    $str = str_replace("  ", "", $str);
    $str = str_replace(" ", "", $str);
    // Set string to uppercase
    $str = strtoupper($str);
    // Compare string with mirror
    if ($str == strrev($str))
        return true;
    else
        return false;
}

// Define func5
function func5()
{
    $word = "  oLo lO  ";
    if (isPalindrome($word))
        echo "Строка \"$word\" является палиндромом без учета пробелов и регистра";
    else
        echo "Строка \"$word\" не является палиндромом без учета пробелов и регистра";
}

func5();
echo '</br></br>';

// Task #6
echo '<h3>Задание #6</h3>';
$result = date("d.m.Y H:i");
echo "$result<br/>";
$result = mktime(0, 0, 0, 2, 24, 2016);
echo "$result<br/>";
echo '</br>';


// Task #7
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
// Run function
PacketsCount("RX packets:950381 errors:0 dropped:0 overruns:0 frame:)0. ");
// Count packets
function PacketsCount($string)
{
    preg_match("/packets:[0-9]*/", $string, $packetsCount);
    $packetsCount = preg_replace("/packets:/", "", $packetsCount);
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
echo '<h3>Задание #9</h3>';
function func9($filename)
{
    return file_get_contents($filename);
}

echo func9("Test.txt");
//echo '</br></br>';


// Task #10
file_put_contents("anothertest.txt", "Hello again!");
//echo '</br></br>';

?>

