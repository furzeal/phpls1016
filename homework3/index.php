<?php
// Header
// Принято полностью
echo '<h2>PHP course loftschool. Домашнее задание #3. Максим Шаталов</h2><br/>';

// Task #1
// Принято
echo '<h3>Задание #1</h3>';
// Read xml
$xml = simplexml_load_file('data.xml');
// Get attributes
foreach ($xml->attributes() as $a => $b) {
    if ($a == "PurchaseOrderNumber") {
        $attrDesc = "Order number: ";
    }
    if ($a == "OrderDate") {
        $attrDesc = "Order date: ";
    }
    if (isset($attrDesc)) {
        echo $attrDesc, $b, "\n";
    }
}
echo "</br></br>";
// Address information
foreach ($xml->Address as $address) {
    echo $address['Type'], " address: ";
    echo "</br>";
    foreach ($address->children() as $name => $child) {
        echo "$name: $child</br>";
    }
    echo "</br>";
}
// Delivery notes
$deliveryNotes = (string)$xml->DeliveryNotes;
echo "Delivery Notes: $deliveryNotes</br></br>";
// Items
foreach ($xml->Items->Item as $item) {
    echo "Part number: ", $item['PartNumber'];
    echo "</br>";
    foreach ($item->children() as $name => $child) {
        echo "$name: $child</br>";
    }
    echo "</br>";
}
echo "</br>";

// Task #2
// Принято

echo '<h3>Задание #2</h3>';
// Create array
$colors = ['red', 'green', 'blue'];
$nested = ['paper' => 'A4', 'orientation' => 'Portrait', 'colors' => $colors];
// Encode array
$filename1 = 'output.json';
$filename2 = 'output2.json';
file_put_contents($filename1, json_encode($nested));
// Get output.json
$output = file_get_contents($filename1);
// Change file if needed
$output2 = changeJSON($output);
function changeJSON($output)
{
    // Get random number
    $result = $output;
    $rand = rand(0, 100);
    // Change data
    if ($rand > 50) {
        $result = str_replace("Portrait", "Album", $output);
        $result = str_replace("A4", "A3", $result);
    }
    return $result;
}

// Save file
file_put_contents($filename2, $output2);
// Show JSON difference
showDifference($filename1, $filename2);
function showDifference($filename1, $filename2)
{
    // Open files
    $input = file_get_contents($filename1);
    $arr1 = (array)json_decode($input);
    //print_r($arr1);
    $input = file_get_contents($filename2);
    $arr2 = (array)json_decode($input);
    //print_r($arr2);
    // Compare JSON
    if ($arr1 === $arr2) {
        echo "Отличающиеся элементы в $filename1 и $filename2 отсутствуют.";
    } else {
        // Compare arrays
        foreach ($arr1 as $key => $value) {
            $element1 = $arr1[$key];
            $element2 = $arr2[$key];
            if ($element1 !== $element2) {
                echo "В файлах отличаются значения элемента '", $key, "'<br/>";
                echo "$filename1: $element1, $filename2: $element2<br/>";
            }
        }
    }
}

echo "</br>";

// Task #3
// Принято
echo '<h3>Задание #3</h3>';
// Create array
$count = rand(50, 60);
$numbers = getRandomNumbers($count);
function getRandomNumbers($count)
{
    // Зачем так? Проще:
    // for ($i = 0; $i < $count-1; $i++) {
    // Если так сделать, не придется создавать 0 элемент
    // Если эе 0 элемент задан для инциализации массива, нагляднее и удобнее переменную инициализировать пустым массивом
    // $result = array();
    $result[0] = rand(1, 100);
    for ($i = 1; $i < $count; $i++) {
        $result[] = rand(1, 100);
    }
    return $result;
}

// Open file for writing
$filename = "task3.cvs";
$file = fopen($filename, 'w');
fputcsv($file, $numbers);
fclose($file);

// Open file for reading
$file = fopen($filename, 'r');
$numbers = fgetcsv($file);

// Calc sum of even numbers
$evensSum = getEvensSum($numbers);
echo "Сумма четных чисел массива равна $evensSum";
function getEvensSum($numbers)
{
    $sum = 0;
    for ($i = 1; $i < count($numbers); $i += 2) {
        $sum += $numbers[$i];
    }
    return $sum;
}

echo "</br></br>";

// Task #4
// Принято
echo '<h3>Задание #4</h3>';
// initialize session
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result_json = curl_exec($curl);
curl_close($curl);
$result = json_decode($result_json, true);
//echo '<pre>';
//var_dump($result);
//echo '</pre>';
//echo($result->query);
// Get title value
echo "title is \"",getValueByKey($result, 'title'),"\"<br/>";
// Get pageid value
echo "pageid is \"",getValueByKey($result, 'pageid'),"\"<br/>";
// Search key
function getValueByKey($input, $key)
{
    foreach ($input as $currentKey => $value) {
        if ($currentKey === $key) {
            return $value;
        }
        if (is_array($value)) {
            return getValueByKey($value, $key);
        }
    }
    return null;
}