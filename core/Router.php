<?php


namespace App\core;


class Router
{

    // variable for Request Class
    public Request $request;

    // variable for Response Class 
    public Response $response;

    /*
    protected array $routes = [
            'get' => [
                '/' = $callback,
                '/contact' = $second_callback
            ],
            'post' => [
                '/' => $callback,
                '/about' => $second_callback
            ]
        ];
    */
    protected array $routes = [];


    /**
     * pass two object as argument: Request, Response 
     */
    public function __construct(\App\core\Request $request, \App\core\Response $response)
    {
        $this->request  = $request;     // set Object to this class properties 
        $this->response = $response;    // set Object to this class properties 
    }



    /**
     * Set the get Request to route array 
     * Example:
     *        [
     *      'get' => [
     *          '/' = $callback,
     *          '/contact' = $second_callback
     *       ],
     *      'get' => [
     *         
     *        
     *   ]
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }


    /**
     * full the route array for get requestes 
     * Example:
     *        [
     *      'post' => [
     *          '/contact' => array
     *                  (
     *                      [0] => object,
     *                      [1] => file name
     *                   ),
     *          '/register' = $second_callback
     *       ],
     *      'post' => [
     *         
     *        
     *   ]
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    /**
     * get path of url and type of request get or post ...
     */
    public function resolve()
    {

        // path of url
        $path   = $this->request->getPath();


        // method type post or get
        $method = $this->request->getMethod();


        /**
         * give us value of 2D array of routes object 
         */
        $callback = $this->routes[$method][$path] ?? false; // if the value is not exist it will take false

        // print_r($callback);

        // page not found 
        if ($callback === false) {
            $this->response->setStatusCode(404);
            // Application::$app->controller = new $callback[0];
            return $this->renderView('_404');
        }

        if (is_string($callback)) {
            // echo 'is string';
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            // echo 'is array';
            Application::$app->controller = new $callback[0];
            // print_r(Application::$app->controller);
        }


        return call_user_func($callback, $this->request);
    }


    /**
     * render page the user is requested, with passing some values 
     * $view is page name, $param is variables inside this page 
     */
    public function renderView($view, array $param = [])
    {
        // give us the content of main.php file 
        $layoutContent = $this->LayoutContent();
        $viewContent = $this->renderOnlyView($view, $param);

        return str_replace('{{content}}', $viewContent, $layoutContent);
        // require_once Application::$ROOT_DIR . "/views/$view.php";
    }



    /**
     * give us HTML page, return content of html page as string  
     */
    protected function LayoutContent()
    {
        $Layout = Application::$app->controller->layout ?? 'main';
        ob_start();
        require_once Application::$ROOT_DIR . "/views/layout/$Layout.php";
        return ob_get_clean();
    }


    protected function renderOnlyView($view, array $params = [])
    {

        // declare variables that is needed inside the reder page by creating varaibles 
        // using $$key 
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        require_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
