<?php

class AdminController extends Controller {
    function ShowAdminPanel() {
        if (! $this->user->check()) {
            Die("FUCK OFF!");
            //header('Location:/personal');
        }
        $this->render('fullpage@admin/index');
    }

    function ShowEditCataloguePage ($category = 0) {

        $this->render('fullpage@admin/editCatalogue', array("categories" => array()));
    }
}