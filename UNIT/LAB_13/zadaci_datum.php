<?php
// PHP Laboratorijske vježbe - Vježba 13 [cite: 1]

// --- ZADATAK 1: Petak 13. --- [cite: 5]
echo "<h3>1. Mjeseci u kojima je 13. dan petak</h3>";
?>
    <form method="POST">
        Unesite godinu: <input type="number" name="godina_petak" value="<?= date('Y') ?>">
        <input type="submit" name="trazi_petak" value="Pronađi mjesece">
    </form>

<?php
if (isset($_POST['trazi_petak'])) {
    $godina = intval($_POST['godina_petak']);
    echo "U godini $godina, petak 13. je u: <ul>";
    for ($mjesec = 1; $mjesec <= 12; $mjesec++) {
        $vrijeme = mktime(0, 0, 0, $mjesec, 13, $godina);
        if (date('N', $vrijeme) == 5) {
            echo "<li>" . date('F', $vrijeme) . "</li>";
        }
    }
    echo "</ul>";
}

echo "<hr>";

// --- ZADATAK 2: Starost u danima --- [cite: 6]
echo "<h3>2. Izračun starosti u danima</h3>";
?>
    <form method="POST">
        Dan: <input type="number" name="d" min="1" max="31" required>
        Mjesec: <input type="number" name="m" min="1" max="12" required>
        Godina: <input type="number" name="g" required>
        <input type="submit" name="racunaj_starost" value="Izračunaj">
    </form>

<?php
if (isset($_POST['racunaj_starost'])) {
    $dan = $_POST['d'];
    $mj = $_POST['m'];
    $god = $_POST['g'];

    if(checkdate($mj, $dan, $god)) {
        $rodjenje = new DateTime("$god-$mj-$dan");
        $danas = new DateTime();
        $razlika = $danas->diff($rodjenje);
        echo "<p>Vaša starost je: <strong>" . $razlika->days . "</strong> dana.</p>";
    } else {
        echo "<p style='color:red;'>Unijeli ste nepostojeći datum!</p>";
    }
}

echo "<hr>";

echo "<h3>3. Prijestupne godine između 1979. i 2037.</h3>";
echo "<p>";
for ($i = 1979; $i <= 2037; $i++) {
    if (date('L', mktime(0, 0, 0, 1, 1, $i))) {
        echo $i . ", ";
    }
}
echo "</p>";
?>