<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Traits\CodeTrait;
use App\Models\Str;

class MathController extends Controller
{
    use CodeTrait;

    protected function _abs($code = "abs(-4.2);") {
        $str = new Str;

        $str->function = "abs";
        $str->details = "abs(int|float \$num): int|float";
        $str->example = "abs(-4.2);";

        $str->code = $code;
        $test = "\$str->output = " . $str->code;
        eval($test);
        
        return inertia('Php/Index', compact('str'));
    } 
}
