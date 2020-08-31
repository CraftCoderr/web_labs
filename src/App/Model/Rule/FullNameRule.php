<?php


namespace App\Model\Rule;


use Core\Model\FormRule;

class FullNameRule implements FormRule
{

    public function check($value)
    {
        $parts = explode(' ', trim($value));
        if (count($parts) != 3) {
            return false;
        }
        for ($i = 0; $i < 3; $i++) {
            if (strlen($parts[$i]) == 0) {
                return false;
            }
        }
        return true;
    }

    public function getError($title): string
    {
        return 'Поле ' . $title . ' должно содержать три слова, разделенные одним пробелом';
    }
}