<?php


namespace Core\Model;


class FormValidator
{

    private $fields = [];
    private $errors = [];

    public function validate($form) : bool
    {
        foreach ($this->fields as $key => $field) {
            if (array_key_exists($key, $form)) {
                $value = $form[$key];
            } else {
                $value = null;
            }
            $field->validate($this, $key, $value);
        }
        return count($this->errors) == 0;
    }


    public function add($key, $field) : self
    {
        $this->fields[$key] = $field;
        return $this;
    }

    public function error($field, $error)
    {
        if (array_key_exists($field, $this->errors)) {
            $this->errors[$field][] = $error;
        } else {
            $this->errors[$field] = [$error];
        }
    }

    public function getErrors() : array
    {
        return $this->errors;
    }


}