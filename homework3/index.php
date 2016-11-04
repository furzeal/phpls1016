<?php
// Header
echo '<h2>PHP course loftschool. Домашнее задание #3. Максим Шаталов</h2><br/>';

// Task #1
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

// Task #3
echo '<h3>Задание #3</h3>';
// Create array
$count = rand(50, 60);
$numbers = getRandomNumbers($count);
function getRandomNumbers($count)
{
    $result[0] = rand(1, 100);
    for ($i = 1; $i < $count; $i++) {
        $result[] = rand(1, 100);
    }
    return $result;
}

// Open file
$filename = "task3.cvs";
$file = fopen($filename, 'w');
fputcsv($file, $numbers);
fclose($file);
$file = fopen($filename, 'r');
$numbers = fgetcsv($file);
function getEvensSum($numbers)
{
    $sum = 0;
    for ($i = 1; $i < count($numbers); $i += 2) {
        $sum += $numbers[$i];
    }
    return $sum;
}

$evensSum = getEvensSum($numbers);
echo "Сумма четных чисел массива равна $evensSum";
echo "</br></br>";
