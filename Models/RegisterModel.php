<?php

namespace App\Models;

use App\core\Model;

class RegisterModel extends Model
{
    public string $Username;
    public string $Email;
    public string $password;


    public function register()
    {
        echo 'creat new user';
    }


    public function rules(): array
    {
        /**
         * TODO: we stop here at 1:45:00
         * set rules for validate the data that's come from user  
         * 
         */
        return [
            'Username' => [self::RULE_REQUIIRED],
            'Email' => [self::RULE_REQUIIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIIRED]
        ];
    }
}
