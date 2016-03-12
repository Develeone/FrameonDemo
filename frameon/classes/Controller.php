<?php
class Controller extends Singleton {
	// Вызовы методов проверяем, чтоб требуемые методы существовали
	function __call ($methodName, $args = array()) {
		if (method_exists($this, $methodName))
			return call_user_func_array(array($this, $methodName), $args);
		else
			throw new Except('Ошибка в контроллере '.get_called_class().'. Отсутствует метод '.$methodName.'!');
	}

	private $viewsPath = ''; // Путь ко вьюхам

    private $assets = array();

    public $user = NULL;

    function __construct () {
		$this->viewsPath = APP.'views/'; // Определяем папку с views

        $this->user = new User();
	}

    public function render ($target, $variables = array(), $additionalAssets = array()) {
        $target = explode("@", $target);

        $layout = $target[0];
        $view   = $target[1];

        $content = $this->getContent($view, $variables); // Получаем "скомпилированный" output view
        $content = $this->getLayout($content, $layout); // Запихиваем его в layout <?= $content ?\>
        $html    = $this->getResultHtml($content); // Запихиваем в основной скелет <?= $content ?\>

        $this->addAssets(); // Добавляем ассеты (скрипты и стили) из конфигов (TODO: удалить нафиг)
        $html = $this->renderAssets($html); // Приделываем их к имеющемуся $html (TODO: и это тоже)

        echo $html;
    }

    private function getContent ($filename, $variables = array()) {
        extract($variables);

        $contentPath = $this->viewsPath.$filename.'.php';

        // Подключаем содержимое
        if (file_exists($contentPath)) {
            ob_start();
            include $contentPath;
            return ob_get_clean();
        }
        else
            throw new Except('File '.$contentPath.' not found!');
    }

    private function getLayout ($content, $layout) {
        $layoutPath = $this->viewsPath."layouts/$layout.php";

        ob_start();
        include $layoutPath;
        return ob_get_clean();
    }

    private function getResultHtml ($content) {
        ob_start();
        include $this->viewsPath."template.php";
        return ob_get_clean();
    }

    private function addAssets () {
        $scripts = Config::get()->scripts;
        $styles = Config::get()->styles;

        if ($scripts and is_array($scripts)) {
            foreach ($scripts as $script) {
                $this->addScript($script);
            }
        }

        if ($styles and is_array($styles)) {
            foreach ($styles as $style) {
                $this->addStyleSheet($style);
            }
        }
    }

    private function renderAssets ($html) {
        $output = array('head' => '', 'body' => '');

        // Добавляем кастомные скрипты и стили к странице стандартной
        foreach ($this->assets as $item) {
            if ($item['asset'] == 'script') {
                if ($item['type'] == 'inline') {
                    $output[$item['where']] .= '<script type="text/javascript">'.$item['data'].'</script>'."\n";
                } else {
                    $output[$item['where']] .= '<script type="text/javascript" src="'.$item['data'].'"></script>'."\n";
                }
            } else {
                if ($item['type'] == 'inline') {
                    $output[$item['where']] .= '<style>'.$item['data'].'</style>'."\n";
                } else {
                    $output[$item['where']] .= '<link rel="stylesheet" href="'.$item['data'].'" type="text/css" />'."\n";
                }
            }
        }


        if ($output['head']) {
            $html = preg_replace('#(<\/head>)#iu', $output['head'].'$1', $html);
        }

        if ($output['body']) {
            $html = preg_replace('#(<\/body>)#iu', $output['body'].'$1', $html);
        }

        return $html;
    }

	private function addAsset($link, $where = 'head', $asset = 'script', $type = 'url'){
		$hash = md5('addAsset'.$link.$where.$asset.$type); // Чтоб не добавлять случаем одно и то же
		$where = $where == 'head' ? 'head' : 'body';
		$asset = $asset == 'script' ? 'script' : 'style';

		if (!isset($this->assets[$hash])) {
			$this->assets[$hash] = array('where' => $where, 'asset' => $asset, 'type' => $type, 'data' => $link);
		}
	}

	public function addScript($link, $where = 'head'){
		$this->addAsset($link, $where);
	}
	public function addStyleSheet($link, $where = 'head'){
		$this->addAsset($link, $where, 'style');
	}
	public function addScriptDeclaration($data, $where = 'head'){
		$this->addAsset($data, $where, 'script', 'inline');
	}
	public function addStyleSheetDeclaration($data, $where = 'head'){
		$this->addAsset($data, $where, 'style', 'inline');
	}
}
