<?php

$a = 0;
$b = 1;

echo "Deret Fibonacci 10 suku: ";

for ($i = 1; $i <= 10; $i++) {
    echo $a . " ";

    $c = $a + $b;
    $a = $b;
    $b = $c;
}

?>