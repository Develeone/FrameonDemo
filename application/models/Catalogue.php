<?php
class Catalogue extends Registry {
    public $current_category = 0;
    public $subcategories = array();
    public $items = array();
    public $final = false;

    public function GetCategoryById($categoryId = 0) {
        $items = DB::select()
            ->from(Config::get()->db->catalogue_table)
            ->where("parent_id", $categoryId)
            ->get();

        return new Registry(array("type" => (statement)?'intermediate':'final', "items" => $items));
    }

    public function Create($categoryId = 0, $name = '', $description = '') {
        DB::insert(array(
                "name"          => $name,
                "description"   => $description,
                "parent_id"     => $categoryId,
                "name_lat"      => "just_test"
            ))
            ->into(Config::get()->db->catalogue_table)
            ->set();

        return new Registry(array("type" => (statement)?'intermediate':'final', "items" => $items));
    }
}