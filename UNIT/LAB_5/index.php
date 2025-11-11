<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP lab 5 </title>
</head>
<body>

<h2>Zadatak 1 – Indeksirani niz (0–19)</h2>

<?php
// 1) Inicijalizacija niza od 20 elemenata, svaki je petostruka vrijednost indeksa
$niz1 = [];
for ($i = 0; $i < 20; $i++) {
    $niz1[$i] = $i * 5;
}

echo "Zbroj elemenata je: " . array_sum($niz1) . "<br>";
echo "Broj elemenata je: " . count($niz1) . "<br>";

// Brisanje elementa s indeksom 9
unset($niz1[9]);
echo "Nakon brisanja elementa s indeksom 9 broj elemenata je: " . count($niz1) . "<br>";

// Dodavanje novog elementa
$niz1[] = 999;

echo "<br><strong>Svi elementi niza:</strong><br>";
foreach ($niz1 as $k => $v) {
    echo $k . " => " . $v . "<br>";
}
?>

<hr>

<h2>Zadatak 2 – Prosjek, min, max</h2>

<?php
$niz2 = [5, 12, 44, 71, 92, 18, 33];

$prosjek = array_sum($niz2) / count($niz2);
$min = min($niz2);
$max = max($niz2);

echo "Prosjek: $prosjek <br>";
echo "Minimalna vrijednost: $min <br>";
echo "Maksimalna vrijednost: $max <br>";
?>

<hr>

<h2>Zadatak 3 – Asocijativni niz (država → glavni grad)</h2>

<?php
$drzave = [
    "Hrvatska" => "Zagreb",
    "Njemačka" => "Berlin",
    "Italija" => "Rim",
    "Francuska" => "Pariz",
    "Španjolska" => "Madrid"
];

$drzave["Portugal"] = "Lisabon";

foreach ($drzave as $drzava => $grad) {
    echo "$drzava — $grad <br>";
}
?>

<hr>

<h2>Zadatak 4 – array_keys(), array_values()</h2>

<?php
$kljucevi = array_keys($drzave);
$vrijednosti = array_values($drzave);

echo "<pre>";
print_r($kljucevi);
print_r($vrijednosti);
echo "</pre>";
?>

<hr>

<h2>Zadatak 5 – Unija, razlika, presjek</h2>

<?php
$prvi = ["jabuka", "kruška", "ananas", "kivi", "jagoda"];
$drugi = ["jagoda", "šljiva", "malina"];
$treci = ["jagoda", "jabuka", "kupina", "mango"];

$unija = array_unique(array_merge($prvi, $drugi, $treci));
$razlika = array_diff($prvi, $drugi);
$presjek = array_intersect($prvi, $drugi);

echo "Unija:<br>";
print_r($unija);

echo "<br><br>Razlika (prvi - drugi):<br>";
print_r($razlika);

echo "<br><br>Presjek prvog i drugog:<br>";
print_r($presjek);
?>

</body>
</html>
