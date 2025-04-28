<?php

namespace App\Controllers;

use App\Views\View;

class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Renders the given view with the provided data.
     *
     * @param $view
     * @param array $data
     * @return void
     */
    public function render($view, array $data = []): void
    {
        $this->view->render($view, $data);
    }
}
