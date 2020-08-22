<?php


namespace Core\Model\Rule;


use Core\Model\FormRule;

class Email implements FormRule
{

    public function check($value)
    {
        if (preg_match('([a-zA-Z-_]+@[a-zA-Z-_]+(\.[a-zA-Z]+)+)', $value, $m)) {
            return $value == $m[0];
        }
        return false;
    }

    public function getError($title): string
    {
        return 'Поле ' . $title . ' должно содержать правильный адрес электронной почты';
    }
}