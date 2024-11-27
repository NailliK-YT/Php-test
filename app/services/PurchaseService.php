<?php

require_once '../app/repositories/ArticleRepository.php';
require_once '../app/repositories/CategoryRepository.php';
require_once '../app/services/AuthService.php';
require_once '../app/entities/Purchase.php';

class PurchaseService
{
    public function create(Article $article,int $qty): Purchase
    {
        $authService = new AuthService();
        $purchase = new Purchase(null,$article,$authService->getUser(),$qty);

        if(session_status() == PHP_SESSION_NONE)
            session_start();
        if(!isset($_SESSION['purchases']))
        {
            $_SESSION['purchases']=[];
        }

        $_SESSION['purchases'][] = serialize($purchase);

        return $purchase;
    }
}
