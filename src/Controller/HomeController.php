<?php


namespace App\Controller;


class HomeController
{
    public function index()
    {
        require_once(TEMPLATES_DIR . 'home/index.html.php');
    }
}