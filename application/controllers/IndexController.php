<?php
class IndexController extends Controller {

	// Стандартный запрос на вывод
	function ShowPage () {
		$this->render(
			'fullpage@pages/index'
		);
	}
}
