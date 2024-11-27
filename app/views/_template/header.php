<?php
require_once 'fct.inc.php';
$navCategories = getCategories();
$purchases = getPurchases();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- -->
    <script src="https://kit.fontawesome.com/1038d5e71f.js" crossorigin="anonymous"></script>
    <title><?php echo $title??''; ?></title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MonSite</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php foreach ($navCategories as $navCategory): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="category=<?php echo $navCategory->getId()?>"><?php echo $navCategory->getName()?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- Lien vers le panier avec popover -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" id="cartPopover" data-bs-toggle="popover" data-bs-placement="bottom"
                       data-bs-content="
                           <?php if (count($purchases) > 0): ?>
    <ul>
        <?php foreach ($purchases as $purchase): ?>
            <li>
                <?= $purchase->getArticle()->getName() ?> x<?= $purchase->getQuantity() ?> -
                <?= number_format($purchase->getArticle()->getPrice(), 2, ',', ' ') ?>€
            </li>
        <?php endforeach; ?>
    </ul>
    <a href='validate_purchases.php' class='btn btn-primary btn-sm mt-2'>Valider</a>
                    <?php else: ?>
                        <p>Votre panier est vide.</p>
                    <?php endif; ?>"
                        data-bs-html="true">
                        <i class="fa-solid fa-cart-shopping"></i> Panier
                        <?php if(count($purchases) > 0): ?>
                            <span class="badge bg-danger ms-2"><?= count($purchases) ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Pour gérer le Popover, inclure le script JS de Bootstrap -->
<script>
    // Activer le popover au chargement de la page avec html activé
    document.addEventListener('DOMContentLoaded', function () {
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');

        // Parcourir tous les éléments qui ont le data-bs-toggle="popover"
        [...popoverTriggerList].forEach(popoverTriggerEl => {
            // Initialiser le popover pour chaque élément et activer l'option html: true
            new bootstrap.Popover(popoverTriggerEl, {
                html: true  // Permet l'interprétation du HTML dans le contenu du popover
            });
        });
    });
</script>

<div class="container mt-5">
