<?php


namespace App\Controllers;

use App\core\Application;
use App\core\Controller;
use App\core\Request;

class SiteController extends Controller
{
    /**
     * render contact page from here
     */
    public  function contact()
    {
        return $this->render('contact');
    }


    /**
     * render home page from here
     */
    public  function Home(Request $request)
    {
        $array = [
            "name" => 'baker'
        ];

        return $this->render('home', $array);
    }


    public function CantactHandling(Request $request)
    {
        $body = $request->getBody();

        print_r($request);

        echo '<pre>';
        print_r($body);
        echo '</pre>';

        return 'handling data';
    }
}
