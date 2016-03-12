<?php
class PartsCatalogueController extends Controller {

    function ShowMainPage () {
        $categories = DB::select()->from(Config::get()->db->parts_table)->get();

        $this->render('fullpage@parts_catalogue/index', array(
            "categories" => $categories
        ));
    }

    function ShowCategoryPage ($category, $manufacturer = "None") {
        $this->render(
            'fullpage@parts_catalogue/category',
            array(
                "categories" => $category,
                "manufacturer" => $manufacturer,
            )
        );
    }
}
