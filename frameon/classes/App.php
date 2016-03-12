<?php
class App extends Singleton {

	public function __construct () {
		$this->initSystemHandlers(); // Переопределяем вывод ошибок
	}

	/** Запускаем приложение */
    function start () {
		DB::connect(Config::get()->db); // Запускаем БД
        Router::get()->parse($_SERVER['REQUEST_URI']); // Запускаем роутер
    }

    /**
     * Используется для размножения контроллеров
     * App используется как фабрика
     * @param string $controller    Имя контроллера
     * @param string $action        Имя вызываемого в нем метода
     * @param array $args           Аргументы - их мы напарсили из пути роута роутером
     */
    public function runController ($controller, $action, $args = array()) {
        $controller = App::get($controller); // Создаем требуемый контроллер
        $controller->__call($action, $args); // Вызываем требуемый роутером метод контроллера
    }


	// Переопределяем функции, вызываемые при выбросе Exception'ов и Error'ов
	protected function initSystemHandlers () {
		set_exception_handler(array($this,'handleException'));
		set_error_handler(array($this,'handleError'),error_reporting());
	}

	public function handleError ($code,$message,$file,$line) {
		if($code & error_reporting()) {
			restore_error_handler();
			restore_exception_handler();
			try{
				$this->displayError($code,$message,$file,$line);
			} catch(Exception $e) {
				$this->displayException($e);
			}
		}
	}

	public function handleException ($exception) {
		restore_error_handler();
		restore_exception_handler();
		$this->displayException($exception);
	}

	public function displayError ($code,$message,$file,$line) {
		echo "<h1>PHP Error [$code]</h1>\n";
		echo "<p>$message ($file:$line)</p>\n";
		echo '<pre>';

		$trace = debug_backtrace();

		if (count($trace)>3)
			$trace = array_slice($trace,3);
		
		foreach ($trace as $i => $t) {
			if (!isset($t['file']))
				$t['file'] = 'unknown';
			if (!isset($t['line']))
				$t['line'] = 0;
			if (!isset($t['function']))
				$t['function'] = 'unknown';

			echo "#$i {$t['file']}({$t['line']}): ";

			if (isset($t['object']) && is_object($t['object']))
				echo get_class($t['object']).'->';

			echo "{$t['function']}()\n";
		}

		echo '</pre>';

		exit();
	}

	public function displayException ($exception) {
		echo '<h1>'.get_class($exception)."</h1>\n";
		echo '<p>'.$exception->getMessage().' ('.$exception->getFile().':'.$exception->getLine().')</p>';
		echo '<pre>'.$exception->getTraceAsString().'</pre>';
	}
}