<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Str;

trait CodeTrait {
    public function index() {
        echo 'heelo';
    }

    public function testcode(Request $request)  {
        try{

            $str = new Str;
            
            $code = $request->testcode;
            
            if (str_contains($code, "addcslashes")) { // String
                $str->function = "addcslashes";
                $str->details = "addcslashes(string \$string, string \$characters): string";
                $str->example = "addcslashes('foo[ ]', 'A..z');";
            }
            else if (str_contains($code, "substr")) {
                $str->function = "substr";
                $str->details = "substr(string \$string, int \$offset, ?int \$length = null): string";
                $str->example = "substr('abc',2,1);";
            }
            else if (str_contains($code, "str_contains")){
                $str->function = "str_contains";
                $str->details = "str_contains(string \$haystack, string \$needle): bool";
                $str->example = "str_contains('abcdef', 'ef');";
            }
            else if (str_contains($code, "str_ends_with")){
                $str->function = "str_ends_with";
                $str->details = "str_ends_with(string \$haystack, string \$needle): bool";
                $str->example = "str_ends_with('abcdef', 'ef');";
            }
            if (str_contains($code, "abs"))  { //Math
                $str->function = "abs";
                $str->details = "abs(int|float \$num): int|float";
                $str->example = "abs(-4.2);";
            }
            else if (str_contains($code, "max"))  {
                $str->function = "max";
                $str->details = "max(mixed \$value, mixed ...\$values): mixed";
                $str->example = "max(2, 3, 1, 6, 7); ";
            }
            else if (str_contains($code, "sqrt"))  {
                $str->function = "sqrt";
                $str->details = "sqrt(float \$num): float";
                $str->example = "sqrt(10);";
            }
            else if (str_contains($code, "octdec"))  {
                $str->function = "octdec";
                $str->details = "octdec(string \$octal_string): int|float";
                $str->example = "octdec('77');";
            }
            else if (str_contains($code, "is_finite"))  {
                $str->function = "is_finite";
                $str->details = "is_finite(float \$num): bool";
                $str->example = "is_finite(log(10));";
            }
            else if (str_contains($code, "is_infinite"))  {
                $str->function = "is_infinite";
                $str->details = "is_infinite(float \$num): bool";
                $str->example = "is_infinite(log(0));";
            }
            else if (str_contains($code, "is_nan"))  {
                $str->function = "is_nan (Finds whether a value is not a number)";
                $str->details = "is_nan(float \$num): bool";
                $str->example = "is_nan(acos(8));";
            }
            else if (str_contains($code, "acos"))  {
                $str->function = "acos (Inverse Cosine)";
                $str->details = "acos(float \$num): float";
                $str->example = "acos(0.5);";
            }
            else if (str_contains($code, "hypot"))  {
                $str->function = "hypot (Hypotenuse)";
                $str->details = "hypot(float \$x, float \$y): float";
                $str->example = "hypot(3, 4);";
            }
            else    {
                $str->function = "Random";
                $str->details = "Other php functions";
                $str->example = "substr('abc',2,1);";
            }
            
            $str->code = $code;
            $test = "\$str->output = " . $str->code;
            eval($test);

        }
        catch (Exception $e)   {
            dd($e);
        }
        
        return inertia('Php/Index', compact('str'));
    }
}