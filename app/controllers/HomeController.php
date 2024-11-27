<?php

require_once '../app/services/ArticleService.php';
require_once '../app/services/PurchaseService.php';
require_once '../app/core/Controller.php';
require_once '../app/entities/Purchase.php';
require_once '../app/trait/FormTrait.php';

class HomeController extends Controller
{
    use FormTrait;
    public function index()
    {
        $service = new ArticleService();
        $articles = $service->allArticles();

        $this->view('index', 'Bienvenue dans notre boutique', ['articles' => $articles]);
    }

    public function purchase()
    {
        $articleService = new ArticleService();
        $purchaseService = new PurchaseService();
        $article = $articleService->find($this->getQueryParam('article_id'));

        $purchaseService->create($article,$this->getPostParam('quantity'));

        $this->redirectTo('index.php');
    }
}