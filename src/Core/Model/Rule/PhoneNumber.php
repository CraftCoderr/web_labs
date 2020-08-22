<?php


namespace Core\Model\Rule;


use Core\Model\FormRule;

class PhoneNumber implements FormRule
{

    public function check($value)
    {
        if (preg_match('(\+\d{11})', $value, $m)) {
            return $value == $m[0];
        }
        return false;
    }

    public function getError($title): string
    {
        return 'Поле' . $title . ' должно содержать правильный номер телефона.';
    }
}