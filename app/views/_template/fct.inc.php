<?php
function getCategories(): array
{
    $file = __DIR__ . '/../../repositories/CategoryRepository.php';
    $categories = [];
    if (file_exists($file)) {
        include_once $file;
        $categoryRepository = new CategoryRepository();
        if (method_exists($categoryRepository, 'findAll')) {
            $categories = $categoryRepository->findAll();
        }
    }
    return $categories;
}

function getPurchases(): array
{
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    $purchases = [];

    if(!isset($_SESSION['purchases'])){
        return $purchases;
    }

    foreach ($_SESSION['purchases'] as $purchase) {
        $purchases[] = unserialize($purchase);
    }

    return $purchases;
}
?>