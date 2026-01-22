<html>
<head>
    <title>Vježba 13 - Forma za unos</title>
    <meta charset="UTF-8">
    <script>
        function provjeri(form) {
            let greska = "";

            if (form.ime.value == "") greska += "Ime nije uneseno.\n";
            if (form.prezime.value == "") greska += "Prezime nije uneseno.\n";

            let k_ime = form.korisnicko_ime.value;
            if (k_ime.length < 5) greska += "Korisničko ime mora imati barem 5 znakova.\n";
            if (/[^a-zA-Z0-9_-]/.test(k_ime)) greska += "Korisničko ime sadrži nedopuštene znakove.\n";

            let lozinka = form.lozinka.value;
            if (lozinka.length < 6) greska += "Lozinka mora imati barem 6 znakova.\n";
            if (!/[a-z]/.test(lozinka) || !/[A-Z]/.test(lozinka) || !/[0-9]/.test(lozinka)) {
                greska += "Lozinka mora imati barem jedno malo slovo, jedno veliko slovo i jedan broj.\n";
            }

            let dob = parseInt(form.dob.value);
            if (isNaN(dob) || dob < 18 || dob > 100) greska += "Dob mora biti između 18 i 100.\n";

            let email = form.email.value;
            if (!((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_]/.test(email)) {
                greska += "E-mail adresa nije ispravna.\n";
            }

            if (greska == "") return true;
            else {
                alert(greska);
                return false;
            }
        }
    </script>
</head>
<body>
<table border="0" cellpadding="2" cellspacing="5" bgcolor="#FFCC66">
    <th colspan="2" align="center">Unos novog korisnika</th>
    <form method="post" action="UnesiKorisnika.php" onSubmit="return provjeri(this)">
        <tr><td>Ime:</td><td><input type="text" name="ime"></td></tr>
        <tr><td>Prezime:</td><td><input type="text" name="prezime"></td></tr>
        <tr><td>Korisničko ime:</td><td><input type="text" name="korisnicko_ime"></td></tr>
        <tr><td>Lozinka:</td><td><input type="password" name="lozinka"></td></tr>
        <tr><td>Dob:</td><td><input type="number" name="dob"></td></tr>
        <tr><td>E-mail:</td><td><input type="text" name="email"></td></tr>
        <tr><td colspan="2" align="center"><input type="submit" value="Unesi"></td></tr>
    </form>
</table>
</body>
</html>