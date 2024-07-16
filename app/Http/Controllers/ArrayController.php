<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArrayController extends Controller
{
    function array_change_key_case()    {
        $input_array = array("FirSt" => 1, "SecOnd" => 4);
        return (array_change_key_case($input_array, CASE_LOWER));
    }
    function array_chunk()  {
        $input_array = array('a', 'b', 'c', 'd', 'e');
        return (array_chunk($input_array, 3));
        // return (array_chunk($input_array, 2, true));
    }
    function array_column() {
        // Array representing a possible record set returned from a database
        $records = array(
            array(
                'id' => 2135,
                'first_name' => 'John',
                'last_name' => 'Doe',
            ),
            array(
                'id' => 3245,
                'first_name' => 'Sally',
                'last_name' => 'Smith',
            ),
            array(
                'id' => 5342,
                'first_name' => 'Jane',
                'last_name' => 'Jones',
            ),
            array(
                'id' => 5623,
                'first_name' => 'Peter',
                'last_name' => 'Doe',
            )
        );
        
        $first_names = array_column($records, 'first_name');
        return ($first_names);
    }
    function array_combine()    {
        $a = array('green', 'red', 'yellow');
        $b = array('avocado', 'apple', 'banana'); // length kena sama
        $c = array_combine($a, $b);

        return ($c);
    }
    function array_count_values()   {
        $array = array(1, "hello", 1, "world", "hello");
        return(array_count_values($array));
    }
    function array_diff_assoc() {
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "green", "yellow", "red");
        $result = array_diff_assoc($array1, $array2);
        return ($result);
    }
}
