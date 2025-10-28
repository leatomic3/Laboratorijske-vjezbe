<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP vježbe – funkcije i petlje</title>
</head>
<body>

<h2>1. Funkcije – parametri i povratne vrijednosti</h2>
<form method="post">
    <label>Bodovi prvog kolokvija:</label>
    <input type="number" name="k1" required><br><br>
    <label>Bodovi drugog kolokvija:</label>
    <input type="number" name="k2" required><br><br>
    <input type="submit" name="provjeri" value="Provjeri uspjeh">
</form>

<?php
function ocjenaKolokvija($k1, $k2) {
    if ($k1 < 40 || $k2 < 40) {
        return "Pad – jedan od kolokvija ispod 40 bodova.";
    } elseif (($k1 >= 40 && $k1 <= 49) || ($k2 >= 40 && $k2 <= 49)) {
        return "Potrebno ponavljanje kolokvija.";
    } elseif ($k1 >= 40 && $k2 >= 40 && ($k1 + $k2) >= 100) {
        return "Čestitamo! Položeno.";
    } else {
        return "Nedovoljno bodova za prolaz.";
    }
}

if (isset($_POST['provjeri'])) {
    $rezultat = ocjenaKolokvija($_POST['k1'], $_POST['k2']);
    echo "<p><strong>Rezultat:</strong> $rezultat</p>";
}
?>

<hr>

<h2>2. Korištenje globalnih varijabli</h2>
<?php
$v = 50;

function smanji() {
    global $v;
    $v -= 20;
}

function povecaj() {
    global $v;
    $v += 60;
}

smanji();
echo "Vrijednost nakon smanji(): $v<br>";
povecaj();
echo "Vrijednost nakon povecaj(): $v<br>";
?>

<hr>

<h2>3. Statičke varijable</h2>
<?php
function prikaziBroj() {
    static $broj = 20;
    echo $broj . " ";
    $broj++;
}

for ($i = 0; $i < 10; $i++) {
    prikaziBroj();
}
?>

<hr>

<h2>4a. For petlja – ispis neparnih brojeva</h2>
<form method="post">
    <label>Početni broj:</label>
    <input type="number" name="od" required><br><br>
    <label>Krajnji broj:</label>
    <input type="number" name="do" required><br><br>
    <input type="submit" name="forpetlja" value="Prikaži neparne (for)">
</form>

<?php
if (isset($_POST['forpetlja'])) {
    $od = $_POST['od'];
    $do = $_POST['do'];

    echo "<p>Neparni brojevi između $od i $do:</p>";
    for ($i = $od; $i <= $do; $i++) {
        if ($i % 2 != 0) echo "$i ";
    }
}
?>

<hr>

<h2>4b. While petlja – ispis neparnih brojeva</h2>
<form method="post">
    <label>Početni broj:</label>
    <input type="number" name="od2" required><br><br>
    <label>Krajnji broj:</label>
    <input type="number" name="do2" required><br><br>
    <input type="submit" name="whilepetlja" value="Prikaži neparne (while)">
</form>

<?php
if (isset($_POST['whilepetlja'])) {
    $od = $_POST['od2'];
    $do = $_POST['do2'];

    echo "<p>Neparni brojevi između $od i $do:</p>";
    while ($od <= $do) {
        if ($od % 2 != 0) echo "$od ";
        $od++;
    }
}
?>

<hr>

<h2>5. Do...While petlja – djelitelji unesenog broja</h2>
<form method="post">
    <label>Unesi broj:</label>
    <input type="number" name="broj" required>
    <input type="submit" name="djelitelji" value="Prikaži djelitelje">
</form>

<?php
if (isset($_POST['djelitelji'])) {
    $n = $_POST['broj'];
    echo "<p>Djelitelji broja $n su:</p>";
    $i = 1;
    do {
        if ($n % $i == 0) echo "$i ";
        $i++;
    } while ($i <= $n);
}
?>

<hr>

<h2>6. Provjera je li broj prost</h2>
<form method="post">
    <label>Unesi broj:</label>
    <input type="number" name="broj_prost" required>
    <input type="submit" name="provjeri_prost" value="Provjeri">
</form>

<?php
if (isset($_POST['provjeri_prost'])) {
    $broj = $_POST['broj_prost'];
    $jeProst = true;

    if ($broj < 2) {
        $jeProst = false;
    } else {
        for ($i = 2; $i <= $broj / 2; $i++) {
            if ($broj % $i == 0) {
                $jeProst = false;
                break;
            }
        }
    }

    if ($jeProst)
        echo "<p>$broj je prost broj.</p>";
    else
        echo "<p>$broj nije prost broj.</p>";
}
?>

</body>
</html>
