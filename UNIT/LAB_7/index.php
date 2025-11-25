<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>PHP laboratorijske vježbe - Vježba 7</title>
</head>
<body>

<h1>PHP laboratorijske vježbe - Vježba 7</h1>

<h2>1) Parni i neparni brojevi</h2>
<form method="post">
    <label>Unesite cijele brojeve odvojene zarezom:</label><br>
    <input type="text" name="brojevi" size="50" required>
    <br><br>
    <input type="submit" name="zadatak1" value="Prikaži parne i neparne">
</form>

<?php
if (isset($_POST['zadatak1'])) {
    $ulaz = $_POST['brojevi'];
    $dijelovi = explode(',', $ulaz);

    $parni = [];
    $neparni = [];

    foreach ($dijelovi as $d) {
        $d = trim($d);          // makni razmake
        if ($d === '') continue;
        $broj = (int)$d;

        if ($broj % 2 == 0) {
            $parni[] = $broj;
        } else {
            $neparni[] = $broj;
        }
    }

    echo "<p><strong>Parni:</strong> " . implode(', ', $parni) . "</p>";
    echo "<p><strong>Neparni:</strong> " . implode(', ', $neparni) . "</p>";
}
?>

<hr>

<h2>2) Obrada imena i prezimena</h2>
<form method="post">
    <label>Ime:</label>
    <input type="text" name="ime" required>
    <br><br>
    <label>Prezime:</label>
    <input type="text" name="prezime" required>
    <br><br>
    <input type="submit" name="zadatak2" value="Obradi ime i prezime">
</form>

<?php
if (isset($_POST['zadatak2'])) {
    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);

    $puno = $ime . ' ' . $prezime;

    $malo = mb_strtolower($puno, 'UTF-8');

    $veliko = mb_strtoupper($puno, 'UTF-8');


    $lower = mb_strtolower($puno, 'UTF-8');
    $prvaVelika = mb_convert_case($lower, MB_CASE_TITLE, "UTF-8");

    $inicijalIme = mb_substr($ime, 0, 1, 'UTF-8');
    $inicijalPrezime = mb_substr($prezime, 0, 1, 'UTF-8');
    $inicijali = $inicijalIme . '.' . $inicijalPrezime . '.';

    echo "<p><strong>Samo malim slovima:</strong> $malo</p>";
    echo "<p><strong>Sve velikim slovima:</strong> $veliko</p>";
    echo "<p><strong>Prva slova velika:</strong> $prvaVelika</p>";
    echo "<p><strong>Inicijali:</strong> $inicijali</p>";
}
?>

<hr>

<h2>3) Palindrom i ponavljanje niza</h2>
<form method="post">
    <label>Unesite niz znakova:</label><br>
    <input type="text" name="palindrom" size="50" required>
    <br><br>
    <label>Koliko puta ispisati niz:</label><br>
    <input type="number" name="brojPonavljanja" min="1" required>
    <br><br>
    <input type="submit" name="zadatak3" value="Provjeri i ispiši">
</form>

<?php
if (isset($_POST['zadatak3'])) {
    $niz = $_POST['palindrom'];
    $n = (int)$_POST['brojPonavljanja'];


    $cisti = mb_strtolower(preg_replace('/\s+/', '', $niz), 'UTF-8');
    $slova = preg_split('//u', $cisti, -1, PREG_SPLIT_NO_EMPTY);
    $okrenuto = implode('', array_reverse($slova));

    if ($cisti === $okrenuto) {
        echo "<p>Niz <strong>" . htmlspecialchars($niz) . "</strong> JE palindrom.</p>";
    } else {
        echo "<p>Niz <strong>" . htmlspecialchars($niz) . "</strong> NIJE palindrom.</p>";
    }

    echo "<p><strong>Ponavljanje niza $n puta:</strong><br>";
    for ($i = 0; $i < $n; $i++) {
        echo htmlspecialchars($niz) . " ";
    }
    echo "</p>";
}
?>

<hr>

<h2>4) Zamjena dijela stringa (substr_replace)</h2>
<form method="post">
    <label>Originalni niz:</label><br>
    <input type="text" name="org" size="60" required>
    <br><br>

    <label>Novi niz (s kojim zamjenjujemo):</label><br>
    <input type="text" name="novi" size="60" required>
    <br><br>

    <label>Pozicija od koje počinje zamjena (0 = prvi znak):</label><br>
    <input type="number" name="pozicija" min="0" required>
    <br><br>

    <label>Koliko znakova originalnog niza zamijeniti:</label><br>
    <input type="number" name="duljina" min="0" required>
    <br><br>

    <input type="submit" name="zadatak4" value="Zamijeni">
</form>

<?php
if (isset($_POST['zadatak4'])) {
    $org = $_POST['org'];
    $novi = $_POST['novi'];
    $pozicija = (int)$_POST['pozicija'];
    $duljina = (int)$_POST['duljina'];

    $rezultat = substr_replace($org, $novi, $pozicija, $duljina);

    echo "<p><strong>Originalni niz:</strong> " . htmlspecialchars($org) . "</p>";
    echo "<p><strong>Novi niz:</strong> " . htmlspecialchars($novi) . "</p>";
    echo "<p><strong>Rezultat nakon zamjene:</strong> " . htmlspecialchars($rezultat) . "</p>";
}
?>

</body>
</html>
