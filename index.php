<?php 

echo date("l, d/m/Y", strtotime("1970-01-01")) . "<br>";
echo strtotime("2020-02-21") . "<br>";
echo time() . "<br>";

// timestamp para bd
echo date("Y-m-d H:i:s", time()). "<br/>";

//soma e subtração de dadas
$dia = 86400;
echo $data = "2021-02-15";
$nova_data = strtotime($data) - ($dia * 100);
echo "<p>Data menos 100 dias: " . date("d/m/Y", $nova_data) . "</p>";