<?php

class Controller
{

    const APP_URL_PATH = 'controller/';

    public function __construct()
    {
        session_start();
    }

    public function redirect($location)
    {

        ob_clean();
        $location = $location;
        header("Location:$location");
        return;
    }

    public function render($viewFile, $data=[],$error=[])
    {
        $template = __DIR__ . '/../view/' . $viewFile;
        $template = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $template);
        $template = realpath($template);
        include_once $template;
        return;
        /* return readfile($template);
        $html = file_get_contents($template);
        foreach($data as $key => $val) {
            $html = str_replace("{{{$key}}}", $val, $html);
        }

        $html = preg_replace('/{{\w+}}/', '', $html);
        echo $html;
        */
    }

    public function hasUserSession()
    {
        return (isset($_SESSION['uname']) && !empty($_SESSION['uname']));
    }
}