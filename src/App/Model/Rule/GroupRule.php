<?php


namespace App\Model\Rule;


use Core\Model\FormRule;

class GroupRule implements FormRule
{

    public function check($value)
    {
        return $value !== 'Выберите группу';
    }

    public function getError($title): string
    {
        return 'Выберите группу';
    }
}