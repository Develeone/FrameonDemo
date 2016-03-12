<?php
class PageController extends Controller {
	function ShowIndex ($page) {
		$this->render('fullpage.'.$page);
	}
}