<?php


namespace Core\Model\Rule;


class Date implements \Core\Model\FormRule
{

    public function check($value)
    {
        if (preg_match('(\d{1,2}\.\d{1,2}\.\d{4})', $value, $m)) {
            return $value == $m[0];
        }
        return false;
    }

    public function getError($title): string
    {
        return 'Поле ' . $title . ' должно иметь значение день.месяц.год';
    }
}