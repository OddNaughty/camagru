<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/css/main.css"/>
<!--    <link rel="stylesheet" href="../vue/style.css" />-->
</head>

<body>
<div class="wrapper">
    <header>
        <?php
        if (!isset($_SESSION['user'])) { ?>
            <ul>
                <li style="display: inline;"><a href="/controllers/login.php">connexion</a></li>
                <li style="display: inline;"><a href="/controllers/register.php">s'enregistrer</a></li>
            </ul>
            <?php } else { ?>
            <div>
                <a href="/controllers/editing.php">Prend des photos !</a>
                <a href="/controllers/gallery.php">Regarde les photos !</a>
                <a href="/controllers/logout.php">Déconnecte moi !</a>
            </div>
            <?php } ?>
    </header>
    <main>
<!--Must finish class=wrapper in footer-->