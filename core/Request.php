<?php

namespace App\core;

class Request
{




    /**
     * get path of URL that is after domain name 
     * Example :
     *      www.domainname.com/user/ 
     *  path here is : /user
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/'; // if is not represented we take /

        // return position number of ? in string | false otherwise 
        $position = strpos($path, '?');

        // false mean there is no ? in string 
        // return sub string from begine to position of ? in string 
        return ($position === false) ? $path : substr($path, 0, $position);

        // if ($position === false) {
        //     return $path;
        // }

        // return substr($path, 0, $position);
    }


    /**
     * get type of request GET or POST to lower get, post
     */
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * if is get 
     * return true, false otherwise
     */
    public function is_get()
    {
        return $this->getMethod() === 'get';
    }

    /**
     * if is post : return true, false otherwise
     */
    public function is_post()
    {
        return $this->getMethod() === 'post';
    }

    /**
     * filtering the values of post or get arrays before using it 
     * 
     */
    public function getBody()
    {
        $body = [];

        // if the submit is get this will trigger
        if ($this->is_get()) {

            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }


        // if the submit is post this will trigger
        if ($this->is_post()) {

            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}
