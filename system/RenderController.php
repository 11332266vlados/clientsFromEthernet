<?php

namespace system;

class RenderController
{
    private $layout = 'view_layout';

    function render($renderFileName = '', $data = [])
    {
        if (empty($renderFileName)) {
            die('Нет названия вида');
        }
        $renderFile = $_SERVER['DOCUMENT_ROOT'].'/api/Views/'.$renderFileName.'.php';
        $layoutFile = $_SERVER['DOCUMENT_ROOT'].'/api/Views/layout/'.$this->layout.'.php';
        if (file_exists($renderFile)) {

            if(isset($_SESSION) && !empty($_SESSION)){
                $data['session'] = $_SESSION;
            }

            $layout = $this->get_include_contents($layoutFile, $data);
            $content = $this->get_include_contents($renderFile, $data);

            $layout = str_replace('[insert]content[/insert]', $content, $layout);

            echo $layout;
            die();
        } else {
            die('Вид '.$renderFileName.'.php  не найден');
        }
    }

    function get_include_contents($filename,$data)
    {
        if (is_file($filename)) {
            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $$key = $value;
                }
            }
            ob_start();
            include $filename;
            return ob_get_clean();
        }
        return false;
    }
}