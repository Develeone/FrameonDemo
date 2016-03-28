<?php

class AdminController extends Controller {
    function ShowAdminPanel() {
        if (! $this->user->check()) {
            Die("FUCK OFF!");
            //header('Location:/personal');
        }
        $this->render('fullpage@admin/index');
    }

    function ShowEditCataloguePage ($categoryId = 0) {
        $catalogue = new Catalogue();
        $category = $catalogue->GetCategoryById($categoryId);
        $category->id = $categoryId;

        $this->render('fullpage@admin/editCatalogue', array("category" => $category));
    }

    function PostEditCataloguePage ($categoryId = 0) {
        $catalogue = new Catalogue();
        $catalogue->Create($categoryId, $_POST["name"], $_POST["description"]);

        $category = $catalogue->GetCategoryById($categoryId);
        $category->id = $categoryId;

        $this->render('fullpage@admin/editCatalogue', array("category" => $category));
    }
}