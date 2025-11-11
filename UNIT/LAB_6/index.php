<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP lab 6</title>
</head>
<body>

<h2>Zadatak 1 – range(), array_splice()</h2>

<?php
$niz = range(3, 3*15, 3);   // 3,6,9,...45

echo "<strong>Početni niz:</strong><br>";
print_r($niz);

$novi = [];
$novi[] = $niz[5];

echo "<br><br>Element s indeksom 5 premješten u novi niz: ";
print_r($novi);

array_splice($niz, 5, 1);

echo "<br><br>Niz nakon brisanja elementa 5:<br>";
print_r($niz);

array_splice($niz, 2, 3, [-5, -15, -25]);

echo "<br><br>Niz nakon zamjene 3 elementa:<br>";
print_r($niz);
?>

<hr>

<h2>Zadatak 2 – Sortiranje triju nizova</h2>

<?php
$artikl   = ["čokolada", "kava", "kruh", "mlijeko", "novine"];
$vrijeme  = ["Kraš", "Franck", "MiP", "Vindija", "EPH"];
$cijena   = [19.99, 18.45, 7.5, 7, 7];

$combined = [];

for ($i = 0; $i < count($artikl); $i++) {
    $combined[] = [
        "artikl" => $artikl[$i],
        "vrijeme" => $vrijeme[$i],
        "cijena" => $cijena[$i]
    ];
}

usort($combined, function($a, $b) {
    return $a["cijena"] <=> $b["cijena"];
});

echo "<strong>Sortirano po cijeni:</strong><br>";

foreach ($combined as $elem) {
    echo $elem["artikl"] . " | " . $elem["vrijeme"] . " | " . $elem["cijena"] . "<br>";
}
?>

<hr>

<h2>Zadatak 3 – Sortiranje asocijativnog niza</h2>

<?php
$auta = [
    "BMW" => "limuzina",
    "Audi" => "SUV",
    "Fiat" => "gradski",
    "Opel" => "karavan",
    "Ford" => "limuzina",
    "Mercedes" => "SUV"
];

$tip_sort = isset($_POST["tip"]) ? $_POST["tip"] : "1";
$vrsta_sort = isset($_POST["vrsta"]) ? $_POST["vrsta"] : "U";

if ($tip_sort == "1") {
    $tip_txt = "po ključevima";
} else {
    $tip_txt = "po vrijednostima";
}

echo "<strong>Sortiranje $tip_txt ($vrsta_sort):</strong><br><br>";

$sorted = $auta;

// Sortiranje
if ($tip_sort == "1") {
    if ($vrsta_sort == "U") ksort($sorted);
    else krsort($sorted);
} else {
    if ($vrsta_sort == "U") asort($sorted);
    else arsort($sorted);
}

echo "<pre>";
print_r($sorted);
echo "</pre>";
?>

<form method="post">
    Vrsta sortiranja:
    <select name="tip">
        <option value="1">1 (po ključevima)</option>
        <option value="2">2 (po vrijednostima)</option>
    </select>

    <select name="vrsta">
        <option value="U">A (uzlazno)</option>
        <option value="Z">Z (silazno)</option>
    </select>

    <input type="submit" value="Sortiraj">
</form>

<hr>

<h2>Zadatak 4 – Sortiranje niza od 10 elemenata nakon shuffle()</h2>

<?php
$niz10 = [];

for ($i = 0; $i < 10; $i++) {
    $niz10[] = rand(1, 99);
}

echo "Početni niz:<br>";
print_r($niz10);


shuffle($niz10);

echo "<br><br>Nakon shuffle():<br>";
print_r($niz10);

$tip_sortiranja = isset($_POST["sort_niz10"]) ? $_POST["sort_niz10"] : "A";

if ($tip_sortiranja == "A") {
    sort($niz10);
    echo "<br><br>Sortirano uzlazno:<br>";
} else {
    rsort($niz10);
    echo "<br><br>Sortirano silazno:<br>";
}

print_r($niz10);
?>

<form method="post">
    Sortiraj niz od 10 elemenata:
    <select name="sort_niz10">
        <option value="A">A (uzlazno)</option>
        <option value="S">S (silazno)</option>
    </select>

    <input type="submit" value="Sortiraj">
</form>

</body>
</html>
