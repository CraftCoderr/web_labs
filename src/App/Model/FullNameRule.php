<?php


namespace App\Model;


use Core\Model\FormRule;

class FullNameRule implements FormRule
{

    public function check($value)
    {
        if (preg_match('([А-Яа-яA-Za-z]+ [А-Яа-яA-Za-z]+ [А-Яа-яA-Za-z]+)', $value, $m)) {
            return $value == $m[0];
        }
        return false;
    }

    public function getError($title): string
    {
        return 'Поле ' . $title . ' должно содержать три слова, разделенные одним пробелом';
    }
}