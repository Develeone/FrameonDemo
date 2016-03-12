<?php
class Router extends Singleton{

    private static $routes = array();

    function __construct()
    {
        include APP.ROUTES_FILE; // Создаем реестр роутов
    }

    function parse ($path) {
        $regex_variable_name = "/{([a-z]+)}/sui";
        $regex_variable_value = "([a-z0-9_-]+)";

        $variables = array();

		$parts = parse_url($path);

		if (isset($parts['query']) and !empty($parts['query'])) {
			$path = str_replace('?'.$parts['query'], '', $path); // Убираем из path его query
		}

		foreach (self::$routes as $route) {
            if ($route["method"] == $_SERVER['REQUEST_METHOD']) {
                // Компилим готовую регулярку
                $regex_route = preg_replace($regex_variable_name, $regex_variable_value, $route["path"]);

                // Проверяем путь на соответствие ей
                preg_match("%^" . $regex_route . "(/|.php)?$%sui", $path, $params_values);

                if (count($params_values) > 0) {
                    // Парсим имена переменных
                    preg_match_all($regex_variable_name, $route["path"], $params_names);
                    // Берем имена без фигурных скобок - второй эдемент массива
                    $params_names = $params_names[1];

                    // Забиваем переменные
                    for ($i = 0; $i < count($params_names); $i++) {
                        $variables[$params_names[$i]] = $params_values[$i + 1];
                    }

                    $action = explode(".", $route["action"]);
                    $controller_name = $action[0];
                    $action_name = $action[1];
                    App::get()->runController($controller_name, $action_name, $variables);
                    return;
                }
            }
		}

        print_r(self::$routes);
        Die("404");
	}

    public static function set ($method, $path, $action) {
        array_push(self::$routes, array("method" => $method, "path" => $path, "action" => $action));
    }

    function kyr2lat($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }

    function kyr2url($str) {
        $str = self::kyr2lat($str);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        $str = trim($str, "-");
        return $str;
    }

	// Просто для тестов, если хочется - можно где-нибудь вызвать
	function test() {
		echo $path = '/user/',"\n";
		print_r($this->parse($path));
		echo $path = '/user/login/',"\n";
		print_r($this->parse($path));
		echo $path = '/user/profile/15',"\n";
		print_r($this->parse($path));
		echo $path = 'about.html',"\n";
		print_r($this->parse($path));
		echo $path = 'about.html?lenta=1#1',"\n";
		print_r($this->parse($path));
		exit();
	}
}
