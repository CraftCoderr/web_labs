<?php


namespace Core\Model;


class FormField
{

    private $title;
    private $rules;

    public function __construct($title, $rules)
    {
        $this->title = $title;
        $this->rules = $rules;
    }

    public function validate(FormValidator $validator, $key, $value)
    {
        foreach ($this->rules as $rule) {
            if (!$rule->check($value)) {
                $validator->error($key, $rule->getError($this->title));
            }
        }
    }

}