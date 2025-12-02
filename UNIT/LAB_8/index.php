<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>PHP Vježba 8</title>
</head>
<body>
<h1>PHP Vježba 8</h1>

<hr>
<h2>Zadatak 1</h2>
<form method="post">
    Ime: <input type="text" name="ime"><br><br>

    Prezime: <input type="text" name="prezime"><br><br>

    Godine: <input type="number" name="godine"><br><br>

    <button type="submit" name="zadatak1">Pošalji</button>
</form>

<?php

if (isset($_POST['zadatak1'])) {
    $ime     = isset($_POST['ime']) ? trim($_POST['ime']) : '';
    $prezime = isset($_POST['prezime']) ? trim($_POST['prezime']) : '';
    $godine  = isset($_POST['godine']) ? trim($_POST['godine']) : '';

    $podaci = array($ime, $prezime, $godine);
    $csv = implode(',', $podaci);

    echo "<p>Rezultat var_dump niza:</p><pre>";
    var_dump($podaci);
    echo "</pre>";

    echo "<p>CSV tekst: " . htmlspecialchars($csv, ENT_QUOTES, 'UTF-8') . "</p>";
}
?>

<hr>
<h2>Zadatak 2</h2>
<form method="post">
    Web adresa: <input type="text" name="url" size="50">
    <button type="submit" name="zadatak2">Dohvati linkove</button>
</form>

<?php

if (isset($_POST['zadatak2'])) {
    $url = isset($_POST['url']) ? trim($_POST['url']) : '';

    if ($url === '') {
        echo "<p>Unesite adresu.</p>";
    } else {
        if (!preg_match('/^https?:\/\//i', $url)) {
            $url = 'http://' . $url;
        }

        echo "<p>Korištena adresa: " . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . "</p>";

        $html = @file_get_contents($url);

        if ($html === false) {
            echo "<p>Ne mogu dohvatiti sadržaj stranice.</p>";
        } else {
            $pattern = '/<a\s+[^>]*href=["\']([^"\']+)["\'][^>]*>/i';

            if (preg_match_all($pattern, $html, $matches)) {
                echo "<p>Pronađeni linkovi (" . count($matches[1]) . "):</p>";
                echo "<ul>";
                foreach ($matches[1] as $link) {
                    echo "<li>" . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nije pronađen nijedan link.</p>";
            }
        }
    }
}
?>

<hr>
<h2>Zadatak 3</h2>
<form method="post">
    Ime i prezime (bez kvačica, npr. Pero Peric): <input type="text" name="ime_prezime"><br><br>

    Datum rođenja (npr. 1.2.2000. ili 01.02.2000): <input type="text" name="datum"><br><br>

    Broj telefona (0XX XXX XXX ili 0XX XXX XXXX): <input type="text" name="telefon"><br><br>

    E-mail: <input type="text" name="email"><br><br>

    <button type="submit" name="zadatak3">Provjeri</button>
</form>

<?php

if (isset($_POST['zadatak3'])) {
    $ime_prezime = isset($_POST['ime_prezime']) ? trim($_POST['ime_prezime']) : '';
    $datum       = isset($_POST['datum']) ? trim($_POST['datum']) : '';
    $telefon     = isset($_POST['telefon']) ? trim($_POST['telefon']) : '';
    $email       = isset($_POST['email']) ? trim($_POST['email']) : '';

    $is_ime     = preg_match('/^[A-Za-z]+ [A-Za-z]+$/', $ime_prezime);
    $is_datum   = preg_match('/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}\.?$/', $datum);
    $is_telefon = preg_match('/^0[0-9]{1,2} [0-9]{3} [0-9]{3,4}$/', $telefon);
    $is_email   = preg_match('/^[\w\.-]+@[\w\.-]+\.[A-Za-z]{2,}$/', $email);

    echo "<p>Provjera podataka:</p><ul>";

    echo "<li>Ime i prezime (" . htmlspecialchars($ime_prezime, ENT_QUOTES, 'UTF-8') . "): "
        . ($is_ime ? "ispravno" : "neispravno") . "</li>";

    echo "<li>Datum rođenja (" . htmlspecialchars($datum, ENT_QUOTES, 'UTF-8') . "): "
        . ($is_datum ? "ispravan" : "neispravan") . "</li>";

    echo "<li>Telefon (" . htmlspecialchars($telefon, ENT_QUOTES, 'UTF-8') . "): "
        . ($is_telefon ? "ispravan" : "neispravan") . "</li>";

    echo "<li>E-mail (" . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "): "
        . ($is_email ? "ispravan" : "neispravan") . "</li>";

    echo "</ul>";
}
?>

<hr>
<h2>Zadatak 4</h2>

<form method="post">
    <button type="submit" name="zadatak4">Zamijeni godine s 2020</button>
</form>

<?php
if (isset($_POST['zadatak4'])) {
    $tekst = "Porast broja noćenja od 50% očekujemo u drugoj polovici 2017. godine. "
        . "Iduća 2018. godina bit će povijesno najveća po porastu BDP-a. "
        . "Od 2013. godine na drveću će rasti euri koje ćete samo trebati pobrati i odnijeti u banku. "
        . "Kao Švicarska bit ćemo bogati u 2010. godini.";

    $zamijenjeno = preg_replace('/\b20[0-9]{2}\b/', '2020', $tekst);

    echo "<p>Originalni tekst:</p>";
    echo "<p>" . htmlspecialchars($tekst, ENT_QUOTES, 'UTF-8') . "</p>";

    echo "<p>Tekst nakon zamjene godina:</p>";
    echo "<p>" . htmlspecialchars($zamijenjeno, ENT_QUOTES, 'UTF-8') . "</p>";
}
?>

</body>
</html>