<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP lab 4</title>
</head>
<body>

<h1>PHP lab 4</h1>
<h3>Funkcije – vrijednost, referenca, podrazumijevani parametar, varijabilni broj parametara, NZD</h3>
<hr>

<h2>Zadatak 1 – Prosljeđivanje vrijednošću i referencom</h2>

<form method="post">
    Unesite prvi broj: <input type="number" name="a" required><br><br>
    Unesite drugi broj: <input type="number" name="b" required><br><br>
    <input type="submit" name="zamijeni" value="Zamijeni">
</form>

<?php

function zamijeniVrijednoscu($a, $b) {
    $temp = $a;
    $a = $b;
    $b = $temp;
}


function zamijeniReferencom(&$a, &$b) {
    $temp = $a;
    $a = $b;
    $b = $temp;
}

if (isset($_POST['zamijeni'])) {
    $a = $_POST['a'];
    $b = $_POST['b'];

    echo "<p><b>Prije poziva funkcije:</b> prvi = $a, drugi = $b</p>";

    zamijeniVrijednoscu($a, $b);
    echo "<p><b>Nakon poziva zamijeniVrijednoscu:</b> prvi = $a, drugi = $b (vrijednosti se nisu promijenile)</p>";

    zamijeniReferencom($a, $b);
    echo "<p><b>Nakon poziva zamijeniReferencom:</b> prvi = $a, drugi = $b (vrijednosti su zamijenjene)</p>";
}
?>

<hr>


<h2>Zadatak 2 – Podrazumijevana vrijednost parametra</h2>

<form method="post">
    Unesite vrijeme u sekundama: <input type="number" name="t" required><br><br>
    Unesite brzinu zvuka u m/s (za zrak ostavite prazno): <input type="number" name="v"><br><br>
    <input type="submit" name="izracunaj" value="Izračunaj">
</form>

<?php
function prijedeniPut($t, $v = 344) {  // 344 m/s brzina zvuka u zraku
    return $v * $t;
}

if (isset($_POST['izracunaj'])) {
    $t = $_POST['t'];
    $v = $_POST['v'];

    if (empty($v)) {
        $v = 344;
        echo "<p>Korištena je podrazumijevana brzina zvuka od 344 m/s.</p>";
    }

    $put = prijedeniPut($t, $v);
    echo "<p>Vrijeme: $t s<br>Brzina: $v m/s<br><b>Prijeđeni put zvuka: $put m</b></p>";
}
?>

<hr>


<h2>Zadatak 3 – Varijabilni broj parametara</h2>

<form method="post">
    Unesite brojeve odvojene zarezom: <input type="text" name="brojevi" required>
    <input type="submit" name="izracunajProsjek" value="Izračunaj prosjek">
</form>

<?php
function prosjek() {
    $brojArg = func_num_args();
    $zbroj = 0;

    for ($i = 0; $i < $brojArg; $i++) {
        $zbroj += func_get_arg($i);
    }

    if ($brojArg > 0) return $zbroj / $brojArg;
    else return 0;
}

if (isset($_POST['izracunajProsjek'])) {
    $ulaz = $_POST['brojevi'];
    $niz = array_map('floatval', explode(',', $ulaz));

    $prosjekUnesenih = prosjek(...$niz);
    echo "<p>Prosjek unesenih brojeva ($ulaz) je: <b>$prosjekUnesenih</b></p>";

    $prosjek1 = prosjek(5, 14, 25, 67, 10);
    $prosjek2 = prosjek(50, 70, 90);
    echo "<p>Prosjek skupa [5,14,25,67,10] = <b>$prosjek1</b><br>Prosjek skupa [50,70,90] = <b>$prosjek2</b></p>";
}
?>

<hr>

<h2>Zadatak 4 – Najveći zajednički djelitelj (NZD)</h2>

<form method="post">
    Unesite prvi broj: <input type="number" name="br1" required><br><br>
    Unesite drugi broj: <input type="number" name="br2" required><br><br>
    <input type="submit" name="pronadiNZD" value="Pronađi NZD">
</form>

<?php
function nzd($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

if (isset($_POST['pronadiNZD'])) {
    $a = $_POST['br1'];
    $b = $_POST['br2'];
    $rezultat = nzd($a, $b);
    echo "<p>Najveći zajednički djelitelj od $a i $b je: <b>$rezultat</b></p>";
}
?>

</body>
</html>
