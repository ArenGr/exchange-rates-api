<?php

namespace App\Views;

use App\Configs\Config;

class View
{
    /**
     * Renders a view file and passes data to it.
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public function render(string $view, array $data = []): void
    {
        $viewPath = rtrim(Config::get('paths.views'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $view;

        if (file_exists($viewPath)) {
            extract($data);

            include $viewPath;
        } else {
            echo "View file '{$view}' not found!";
        }
    }
}