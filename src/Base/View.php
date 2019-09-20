<?php 

namespace Demo\Base;

class View 
{
    protected $view;

    public function __construct()
    {
        //FIXME: move to dependencies/config
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../templates');
        $this->view = new \Twig\Environment($loader, [
            'cache' => false, //__DIR__ . '/tmp'
        ]);
    }

    /**
     * Render view and return html
     *
     * @param string $view
     * @param array $params
     * @return view /HTML
     */
    public function render($view, $params = [])
    {
        // Render the template
         echo $this->view->render($view, $params);
    }
}