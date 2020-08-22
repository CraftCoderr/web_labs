<?php


namespace Core\Model\Rule;


use Core\Model\FormRule;

class EqualsSecret implements FormRule
{

    private $expected;

    /**
     * Equals constructor.
     * @param $expected
     */
    public function __construct($expected)
    {
        $this->expected = $expected;
    }


    public function check($value)
    {
        return $value === $this->expected;
    }

    public function getError($title): string
    {
        return 'Неправильный ответ';
    }
}