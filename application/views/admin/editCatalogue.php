<?php
    foreach ($category->items as $item) {
        //echo $item->id." | ".$item->name." | ".$item->name_lat." | ".$item->description."<br>";
        echo '<a href="/admin/editCatalogue/'.$item->id.'">'.$item->name.'</a><br>'.$item->description."<br><br>";
    }
?>
<form method="post">
    <input name="name" type="text" placeholder="Заголовок"><br>
    <input name="description" type="text" placeholder="Описание"><br>
    <input name="add" type="submit" value="Добавить">
</form>
