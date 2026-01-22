<?php
$ime = $_POST['ime'] ?? "";
$prezime = $_POST['prezime'] ?? "";
$korisnicko_ime = $_POST['korisnicko_ime'] ?? "";
$lozinka = $_POST['lozinka'] ?? "";
$dob = $_POST['dob'] ?? "";
$email = $_POST['email'] ?? "";

$greska = "";


function provjeri_podatke($ime, $prezime, $k_ime, $pass, $dob, $mail) {
    $poruka = "";
    if ($ime == "") $poruka .= "Nije uneseno ime.<br />";
    if ($prezime == "") $poruka .= "Nije uneseno prezime.<br />";

    if (strlen($k_ime) < 5) $poruka .= "Korisničko ime mora imati barem 5 znakova.<br />";
    if (preg_match('/[^a-zA-Z0-9_-]/', $k_ime)) $poruka .= "Korisničko ime sadrži nedopuštene znakove.<br />";

    if (strlen($pass) < 6) $poruka .= "Lozinka mora imati barem 6 znakova.<br />";
    if (!preg_match('/[a-z]/', $pass) || !preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass)) {
        $poruka .= "Lozinka mora imati barem jedno malo slovo, jedno veliko slovo i jedan broj.<br />";
    }

    if ($dob < 18 || $dob > 100) $poruka .= "Dob mora biti između 18 i 100.<br />";

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) $poruka .= "E-mail adresa nije ispravna.<br />";

    return $poruka;
}

$greska = provjeri_podatke($ime, $prezime, $korisnicko_ime, $lozinka, $dob, $email);

if ($greska == "") {
    echo "<html><head><title>Uspjeh</title></head><body>";
    echo "<h1>Podaci su uspješno uneseni!</h1>";
    echo "<p>Dobrodošli, $ime $prezime.</p>";
    echo "</body></html>";
    exit;
}

echo <<<_PONOVNO
<html><head><title>Greška u unosu</title></head><body>
<table border="0" cellpadding="2" cellspacing="5" bgcolor="#FFCC66">
<th colspan="2" align="center">Unos novog korisnika</th>
<tr><td colspan="2"><font color=red>Pronađene su sljedeće greške:<br />$greska</font></td></tr>
<form method="post" action="UnesiKorisnika.php">
    <tr><td>Ime:</td><td><input type="text" name="ime" value="$ime" /></td></tr>
    <tr><td>Prezime:</td><td><input type="text" name="prezime" value="$prezime" /></td></tr>
    <tr><td>Korisničko ime:</td><td><input type="text" name="korisnicko_ime" value="$korisnicko_ime" /></td></tr>
    <tr><td>Lozinka:</td><td><input type="password" name="lozinka" value="$lozinka" /></td></tr>
    <tr><td>Dob:</td><td><input type="number" name="dob" value="$dob" /></td></tr>
    <tr><td>E-mail:</td><td><input type="text" name="email" value="$email" /></td></tr>
    <tr><td colspan="2" align="center"><input type="submit" value="Unesi ponovno" /></td></tr>
</form>
</table>
</body></html>
_PONOVNO;
?>