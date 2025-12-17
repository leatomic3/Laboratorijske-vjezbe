<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ime_cookie"])) {
    setcookie("ime", $_POST["ime_cookie"], time() + 31536000, "/");
    setcookie("lokacija", $_POST["lokacija"], time() + 31536000, "/");
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ime_session"])) {
    $_SESSION["ime"] = $_POST["ime_session"];
    header("Location: index.php");
    exit();
}

if (isset($_GET["action"])) {
    if ($_GET["action"] === "zaboravi_cookie") {
        setcookie("ime", "", time() - 3600, "/");
        setcookie("lokacija", "", time() - 3600, "/");
        header("Location: index.php");
        exit();
    }

    if ($_GET["action"] === "zaboravi_session") {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
$ime_cookie = $_COOKIE["ime"] ?? "";
$lokacija = $_COOKIE["lokacija"] ?? "";
$ime_session = $_SESSION["ime"] ?? "";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP – Kolačići i Sesija</title>
</head>
<body>

<h2>Kolačići</h2>

<?php if ($ime_cookie || $lokacija) { ?>
    <p>Bok,
        <?php echo $ime_cookie ?: "neznani posjetitelju"; ?>
        <?php echo $lokacija ? "iz mjesta $lokacija" : ""; ?>!</p>

    <p><a href="index.php?action=zaboravi_cookie">Zaboravi kolačiće</a></p>
<?php } else { ?>
    <form method="post">
        <input type="text" name="ime_cookie" placeholder="Ime"><br><br>
        <input type="text" name="lokacija" placeholder="Lokacija"><br><br>
        <input type="submit" value="Zapamti me">
    </form>
<?php } ?>

<hr>

<h2>Sesija</h2>

<?php if ($ime_session) { ?>
    <p>Bok, <?php echo $ime_session; ?>!</p>
    <p><a href="index.php?action=zaboravi_session">Zaboravi sesiju</a></p>
<?php } else { ?>
    <form method="post">
        <input type="text" name="ime_session" placeholder="Ime"><br><br>
        <input type="submit" value="Prijavi se">
    </form>
<?php } ?>

</body>
</html>