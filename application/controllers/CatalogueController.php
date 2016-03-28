<?php
class CatalogueController extends Controller {

    function ShowMainPage () {
        $categories = DB::select()
            ->from(Config::get()->db->catalogue_table)
            ->where("parent_id", "0")
            ->get();

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
