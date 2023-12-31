<?php
namespace App\Forms\Abstract;

abstract class AForm
{
    abstract public function getConfig(): array;
    public function isSubmit(): bool
    {
        // var_dump($this->getMethod());
        $data = ($this->getMethod() == "post")?$_POST:$_GET;
        if(empty($data))
            return false;
        return true;
    }

    public function getMethod(): string
    {
        return strtolower($this->method);
    }

    public function getElements($labels=[], $elements=[]){
        return [
            "labels" => $labels,
            "elements" => $elements
        ];
    }
}