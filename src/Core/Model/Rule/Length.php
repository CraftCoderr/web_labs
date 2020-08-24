<?php


namespace Core\Model\Rule;


use Core\Model\FormRule;

class Length implements FormRule
{

    private $min;
    private $max;

    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function check($value)
    {
        $length = strlen($value);
        if ($this->min !== null && $length < $this->min) {
            return false;
        }
        if ($this->max !== null && $length > $this->max) {
            return false;
        }
        return true;
    }

    public function getError($title): string
    {
        $condition = '';
        if ($this->min !== null) {
            $condition .= ' от ' . $this->min;
        }
        if ($this->max !== null) {
            $condition .= ' до ' . $this->max;
        }
        return 'Поле ' . $title . ' должно содержать' . $condition . ' символов.';
    }
}