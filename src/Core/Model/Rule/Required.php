<?php


namespace Core\Model\Rule;


use Core\Model\FormRule;
use Core\Model\FormValidator;

class Required implements FormRule
{

    public function check($value)
    {
        return $value != null;
    }

    public function getError($title): string
    {
        return 'Поле ' . $title . ' должно быть заполнено';
    }
}