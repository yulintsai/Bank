<?php

class Controller
{
    public function model($model)
    {
        require_once "../Bank/models/$model.php";
        return new $model ();
    }

    public function view(
        $view,
        $data = Array())
    {
        require_once "../Bank/views/$view.php";
    }

    public function css($css)
    {
        echo "<link rel='stylesheet' href='/Bank/css/".$css.".css'>";
    }
    
    public function js($js)
    {
        echo "<script src='/Bank/js/".$js.".js'></script>";
    }
}
