<?php


namespace Core\Model\Rule;


use Core\Model\FormRule;

class Number implements FormRule
{

    private $min;
    private $max;

    /**
     * Number constructor.
     * @param $min
     * @param $max
     */
    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }


    public function check($value)
    {
        if (!is_numeric($value)) {
            return false;
        }
        if ($this->min !== null && intval($value) < $this->min) {
            return false;
        }
        if ($this->max !== null && intval($value) > $this->max) {
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
        return 'Поле ' . $title . ' должно быть числом' . $condition;
    }
}