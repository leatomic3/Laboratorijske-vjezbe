<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>PHP – Lab9 </title>
</head>
<body>

<h1>PHP – Lab 9</h1>

<?php

echo "<h2>Zadatak 1</h2>";

class Artikl1 {
    public $naziv;
    public $proizvodac;

    public function __construct($proizvodac) {
        $this->proizvodac = $proizvodac;
    }

    public function __destruct() {
        echo "Uništavam objekt... 
";
    }
}


$a1 = new Artikl1("Sony");
$a1->naziv = "TV";

$a2 = new Artikl1("Samsung");
$a2->naziv = "Mobitel";

echo $a1->naziv . " - " . $a1->proizvodac . "
";
echo $a2->naziv . " - " . $a2->proizvodac . "
";

echo "<p><i>Poruka \"Uništavam objekt...\" će se ispisati dva puta.</i></p>";


echo "<hr><h2>Zadatak 2</h2>";

class Pijetao {
    public $ime;
    protected $boja = "crveno-smeđa";
    private $glavni = "ne";

    public function pjevaj() {
        echo "kukurikuuuu
";
    }
}

class Pilic extends Pijetao {
    public $ZnakHoroskopa = "Bik";
    protected $boja = "žuta";

    public function pjevaj() {
        echo "pijuuuuuu
";
    }

    public function dohvatiBoju() {
        return $this->boja;
    }
}

$p = new Pijetao();
$pi = new Pilic();

$p->ime = "Pijetao Pero";
$pi->ime = "Pilić Žućko";

echo "<strong>Pijetao:</strong> " . $p->ime . "
";
echo "<strong>Pilić:</strong> " . $pi->ime . "

";

echo "Poziv pjevaj() za pijetla: ";
$p->pjevaj();

echo "Poziv pjevaj() za pilića: ";
$pi->pjevaj();

echo "
<strong>Znak horoskopa pilića:</strong> " . $pi->ZnakHoroskopa . "

";

echo "<p><b>Linije koje bi dizale grešku (komentirane):</b></p>";
echo "<pre>";
echo "// \$p->boja;
";
echo "// \$p->glavni;
";
echo "// \$pi->glavni;
";
echo "</pre>";


echo "<hr><h2>Zadatak 3</h2>";

class Artikl3 {
    public $naziv;
    public $kolicina;
    public $cijena;

    public function RacunajVrijednost() {
        return $this->cijena * $this->kolicina;
    }

    public function AzurirajKolicinu($skol) {
        $this->kolicina += $skol;
        echo "Nova količina: " . $this->kolicina . "
";
    }
}


$a3 = new Artikl3();
$a3->naziv = "Laptop";
$a3->kolicina = 10;
$a3->cijena = 900;

echo "Artikl: " . $a3->naziv . "
";
echo "Početna količina: " . $a3->kolicina . "
";
echo "Cijena: " . $a3->cijena . " kn
";
echo "Vrijednost artikla: " . $a3->RacunajVrijednost() . " kn
";

if (isset($_POST['kol3'])) {
    $unosKol = (int)$_POST['kol3'];
    echo "
Promjena količine: $unosKol
";
    $a3->AzurirajKolicinu($unosKol);
}

?>

<form method="post">
    <label>Unesi količinu (+ ili -) za Zadatak 3:</label>
    <input type="number" name="kol3">
    <button type="submit">Ažuriraj</button>
</form>

<?php

echo "<hr><h2>Zadatak 4</h2>";

class Artikl4 {
    public $naziv;
    public $kolicina;
    public $cijena;

    private $popust = 0;

    public function __set($name, $value) {
        if ($name == "popust") {
            if ($value > 50) {
                echo "Popust je prevelik – postavljam na 0%
";
                $this->popust = 0;
            } else {
                $this->popust = $value;
            }
        }
    }

    public function __get($name) {
        if ($name == "popust") {
            return $this->popust;
        }
        return null;
    }

    public function RacunajVrijednost() {
        return $this->cijena * $this->kolicina;
    }

    public function VrijednostSPopustom() {
        return $this->RacunajVrijednost() * (1 - $this->popust / 100);
    }
}


$a4 = new Artikl4();
$a4->naziv = "Monitor";
$a4->kolicina = 5;
$a4->cijena = 800;

echo "Artikl: " . $a4->naziv . "
";
echo "Vrijednost robe bez popusta: " . $a4->RacunajVrijednost() . " kn

";

if (isset($_POST['popust4'])) {
    $unosPopust = (int)$_POST['popust4'];
    $a4->popust = $unosPopust;

    echo "Postavljeni popust: " . $a4->popust . "%
";
    echo "Vrijednost artikla s popustom: " . $a4->VrijednostSPopustom() . " kn
";
}
?>

<form method="post">
    <label>Unesi popust za Zadatak 4 (u %):</label>
    <input type="number" name="popust4">
    <button type="submit">Primijeni popust</button>
</form>

</body>
</html>