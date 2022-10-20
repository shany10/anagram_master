<?php
include "./dada.php";


class Anagram
{
    public $data;
    public $argument;
    public $arr_sort;
    public $argument_length;
    public $argument_init;
    public function __construct($data, $argument , $int)
    {
        $this->data = $data;
        $this->argument = str_split($argument);
        $this->argument_init = $argument;
        $this->argument_length = count(str_split($argument));


        $this->arr_sort = [];
    }

    public function getData()
    {
        return $this->data;
    }

    public function get()
    {
        var_dump($this->argument);
    }

    public function search($data)
    {
        foreach ($data as $value) {
            $this->sort($value);
        }

        $arr = $this->arr_sort;
        array_shift($this->argument);

        if (count($this->argument) == 0 || count($this->arr_sort) == 0) {
            $this->arr_sort = [];
            foreach ($arr as $val_arr) {
                $this->final_sort($val_arr);
                if(count($this->arr_sort) !== 0) {
                    
                    if($this->argument_init == strval($this->arr_sort[array_key_last($this->arr_sort)])) {
                        array_pop($this->arr_sort);
                    }
                }
            }

            $this->display();
            return;
        }
        $this->arr_sort = [];

        $this->search($arr);
    }

    public function sort($value)
    {
        $occurence = substr_count($this->argument_init, $this->argument[0]);
        if ($occurence == substr_count($value, $this->argument[0])) {
            array_push($this->arr_sort, $value);
        }
    }

    public function final_sort($val_arr)
    {
        $arr = str_split($val_arr);
        array_pop($arr);

        foreach ($arr as $value) {
            $int = 0;
            foreach (str_split($this->argument_init) as $val_argument) {

                if ($val_argument !== $value) {
                    $int++;
                }
            }
            if ($this->argument_length == $int) {
                return;
            }
        }
        $str = implode("" , $arr);
        array_push($this->arr_sort, $str);
    }

    public function display()
    {
        foreach($this->arr_sort as $value) {
            echo $value . "\n";
        }
    }
}

$data = explode("\n", $data);


$anagram = new Anagram($data, $argv[1] , $argv[2]);
$anagram->search($anagram->getData());
// $anagram->get();
