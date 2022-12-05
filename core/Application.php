<?php

namespace App\core;


class Application
{

    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;

    public static Application $app;
    public static string $ROOT_DIR;


    /**
     * Creat three Object: request, Response, Router 
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;

        self::$app = $this; // this will give us all properties and method of this class Application 

        $this->request  = new Request;  // Creat object from Request Class
        $this->response = new Response; // Creat object from Response Class

        $this->router   = new Router($this->request, $this->response);
    }

    public function getcontroller()
    {
        $this->controller;
    }

    public function setcontroller(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * send the result of user request to user 
     */
    public function run()
    {
        echo $this->router->resolve();
    }
}
