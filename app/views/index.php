<?php require_once '../app/views/_template/header.php'; ?>

<div class="most-popular">
    <div class="container">
        <div class="heading-section text-center mb-5">
            <h2 class="mb-4">Bienvenue dans notre boutique</h2>
            <p>Explorez nos produits populaires et découvrez des articles exclusifs à des prix compétitifs.</p>
        </div>
        <div class="row">
            <?php /** @var Article $article */
            foreach ($articles as $article): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm border-light">
                        <!-- Image de l'article -->
                        <img src="assets/images/<?= $article->getId() ?>.jpg"
                             alt="<?= $article->getName() ?>"
                             class="card-img-top"
                             style="object-fit: cover; height: 200px;">

                        <!-- Contenu de la carte -->
                        <div class="card-body">
                            <h5 class="card-title"><?= $article->getName() ?></h5>
                            <h6 class="text-muted"><?= $article->getCategory()->getName() ?></h6>
                            <p class="card-text text-truncate" style="max-height: 60px;"><?= $article->getDescription() ?></p>
                        </div>

                        <!-- Footer de la carte -->
                        <div class="card-footer d-flex">
                            <div>
                                <span class="badge bg-primary">Stock: <?= $article->getStock() ?></span>
                                <span class="badge bg-success">Prix: <?= number_format($article->getPrice(), 2, ',', ' ') ?>€</span>
                            </div>
                            <form method="post" action="purchase.php?article_id=<?= $article->getId() ?>">
                            <div class="input-group">
                                    <input type="number" name="quantity" min="1" max="<?= $article->getStock() ?>" class="form-control" placeholder="Qt" required>
                                    <button class="btn btn-warning btn-sm" type="submit"><i class="fa-solid fa-cart-plus"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php require_once '../app/views/_template/footer.php'; ?>
