<?php


namespace Core\Model;


interface FormRule
{
    public function check($value);

    public function getError($title) : string;
}