<?php

namespace App\core;

abstract class Model
{

    public const RULE_REQUIIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }



    public function validate()
    {
    }

    abstract public function rules(): array;
}
