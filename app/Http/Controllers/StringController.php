<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

use App\Http\Traits\CodeTrait;
use App\Models\Str;

class StringController extends Controller
{
    use CodeTrait;

    protected function _substr($code = "substr(\"abcdef\", 2, 2);") {
        $str = new Str;

        $str->function = "substr";
        $str->details = "substr(string \$string, int \$offset, ?int \$length = null): string";
        $str->example = "substr('abc',2,1);";

        $str->code = $code;
        $test = "\$str->output = " . $str->code;
        eval($test);
        
        return inertia('Php/Index', compact('str'));
    } 

    public function _implode()  {
        return implode(['Izzah', ' ', 'Fatini', ' ', 'Mohd', ' ', 'Nasri']);
    }

    // addcslashes — Quote string with slashes in a C style
    public function addcslashes()  {
        return addcslashes('foo[ ]', 'A..z');
    }

    // addslashes — Quote string with slashes
    public function addslashes()  {
        return addslashes("O'Reilly?");
    }
    
    // bin2hex — Convert binary data into hexadecimal representation
    public function bin2hex()   {
        return bin2hex('Hello world!');
    }
    
    // chop — Alias of rtrim
    public function chop()  {
        $hello  = "\t\tThese are a few words :) ...  ";

        return chop($hello);
        // return rtrim($hello);
    }
    
    // chr — Generate a single-byte string from a number
    public function chr()  {
        return chr(97); //a
    }

    // chunk_split — Split a string into smaller chunks
    public function chunk_split()   {
        // return chunk_split(base64_encode("Yarım kilo çay, yarım kilo şeker"));
        return chunk_split(base64_encode("Hello World"));
    }

    // convert_cyr_string — Convert from one Cyrillic character set to another
    // convert_uudecode — Decode a uuencoded string
    function convert_uudecode() {
        return convert_uudecode("+22!L;W9E(%!(4\"$`\n`"); //Output: I love PHP!
    }

    // convert_uuencode — Uuencode a string
    function convert_uuencode() {
        return convert_uuencode("I love PHP!"); // Output: +22!L;W9E(%!(4"$` `
    }

    // count_chars — Return information about characters used in a string
    // crc32 — Calculates the crc32 polynomial of a string
    // crypt — One-way string hashing
    // echo — Output one or more strings
    // explode — Split a string by a string
    function explode()  {
        $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
        $pieces = explode(" ", $pizza);
        return $pieces[4]; // piece1
        // return $pieces[1]; // piece2
    }

    // fprintf — Write a formatted string to a stream
    // get_html_translation_table — Returns the translation table used by htmlspecialchars and htmlentities
    function get_html_translation_table()   {
        // return get_html_translation_table(HTML_ENTITIES, ENT_QUOTES | ENT_HTML5);
        return get_html_translation_table(HTML_ENTITIES, true);
        // return get_html_translation_table(HTML_SPECIALCHARS);
    }
    // hebrev — Convert logical Hebrew text to visual text
    function hebrev()   {
        // $s = iconv("ISO-8859-8", "UTF-8", hebrev(iconv("UTF-8", "ISO-8859-8", $s)));
        // return hebrev("שלום עולם");
        return hebrev("صباح الخير");
    }
    // hebrevc — Convert logical Hebrew text to visual text with newline conversion
    // hex2bin — Decodes a hexadecimally encoded binary string
    function hex2bin()  {
        return hex2bin("6578616d706c65206865782064617461");
    }
    // htmlentities — Convert all applicable characters to HTML entities
    function htmlentities() {
        // return htmlentities("I'll \"walk\" the <b>dog</b> now");
        return "I'll \"walk\" the <b>dog</b> now";
    }
    // html_entity_decode — Convert HTML entities to their corresponding characters
    function html_entity_decode()   {
        $orig = "I'll \"walk\" the <b>dog</b> now";
        $a = htmlentities($orig);

        $b = html_entity_decode($a);
        return $b;
    }
    // htmlspecialchars — Convert special characters to HTML entities
    function htmlspecialchars() {
        return htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
        // return "<a href='test'>Test</a>";
    }
    // htmlspecialchars_decode — Convert special HTML entities back to characters
    function htmlspecialchars_decode()  {
        $encode = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES); 
        return htmlspecialchars_decode($encode);
    }
    // implode — Join array elements with a string
    function implode()  {
        return implode(['a', 'b', 'c']);
    }
    // join — Alias of implode
    function join()  {
        return join(['ا', 'ب', 'ت']);
    }
    // lcfirst — Make a string's first character lowercase
    function lcfirst()  {
        return lcfirst("Hello");
    }
    // levenshtein — Calculate Levenshtein distance between two strings
    function levenshtein()  {
        $input = 'carrrot'; // input misspelled word

        $words  = array('apple','pineapple','banana','orange', 
                        'radish','carrot','pea','bean','potato'); // array of words to check against
        $shortest = -1; // no shortest distance found, yet

        foreach ($words as $word) { // loop through words to find the closest

            
            $lev = levenshtein($input, $word);  // calculate the distance between the input word, and the current word

            if ($lev == 0) {    // check for an exact match
                $closest = $word;   // closest word is this one (exact match)
                $shortest = 0;
                break;
            }

            // if this distance is less than the next found shortest distance, OR if a next shortest word has not yet been found
            if ($lev <= $shortest || $shortest < 0) {
                $closest  = $word;  // set the closest match, and shortest distance
                $shortest = $lev;
            }
        }

        if ($shortest == 0) {
            return "Exact match found: $closest\n";
        } else {
            return "Input word: $input\n | Closest: $closest?\n";
        }
    }
    // localeconv — Get numeric formatting information
    function localeconv()   {
        return localeconv();
    }
    // ltrim — Strip whitespace (or other characters) from the beginning of a string
    function ltrim()    {
        $text = "\t\tThese are a few words :) ...  ";
        return ltrim($text); // takda beza
    }
    // md5_file — Calculates the md5 hash of a given file
    function md5_file()  {
        $file = 'php-5.3.0alpha2-Win32-VC9-x64.zip';

        // return 'MD5 file hash of ' . $file . ': ' . md5_file($file);
    }
    // md5 — Calculate the md5 hash of a string
    function md5()   {
        return md5("Apple");
    }
    // metaphone — Calculate the metaphone key of a string
    function metaphone()    {
        return metaphone('programming');
        // return metaphone('programming', 3);
    }
    // money_format — Formats a number as a currency string
    // nl_langinfo — Query language and locale information
    function nl_langinfo()  {
        // return nl_langinfo(CODESET);
        return nl_langinfo(YESSTR);
        // return nl_langinfo(N_SIGN_POSN); //Error
    }
    // nl2br — Inserts HTML line breaks before all newlines in a string
    function nl2br()    {
        return nl2br("foo isn't\n bar");
        // return ("foo isn't\n bar");
    }
    // number_format — Format a number with grouped thousands
    function number_format()    {
        $number = 1234.56;

        // english notation (default)
        $english_format_number = number_format($number);
        // 1,235

        // French notation
        $nombre_format_francais = number_format($number, 2, ',', ' ');
        // 1 234,56

        $number = 1234.5678;

        // english notation without thousands separator
        $english_format_number = number_format($number, 2, '.', '');
        // 1234.57

        return $nombre_format_francais;
    }
    // ord — Convert the first byte of a string to a value between 0 and 255 - complements chr()
    function ord()  {
        return ord("a"); //97 - chr(97) = a
    }
    // parse_str — Parses the string into variables - use when query string passed via a URL 
    function parse_str()    {
        $str = "first=value&arr[]=foo+bar&arr[]=baz";

        parse_str($str, $output);
        // return $output['first'];  // value
        return $output['arr'][0]; // foo bar
        // return $output['arr'][1]; // baz
    }
    // print — Output a string
    function print()    {
        return print "hi"; // Output: hi1
    }
    // printf — Output a formatted string
    function printf()   {
        $n =  43951789;
        $u = -43951789;
        $c = 65; // ASCII 65 is 'A'
        // return printf("%%b = '%b'\n", $n); // binary representation
        // return printf("%%c = '%c'\n", $c); // print the ascii character, same as chr() function
        // return printf("%%d = '%d'\n", $n); // standard integer representation
        // return printf("%%e = '%e'\n", $n); // scientific notation
        // return printf("%%u = '%u'\n", $n); // unsigned integer representation of a positive integer
        return printf("%%u = '%u'\n", $u); // unsigned integer representation of a negative integer
        // return printf("%%f = '%f'\n", $n); // floating point representation
        // return printf("%%o = '%o'\n", $n); // octal representation
        // return printf("%%s = '%s'\n", $n); // string representation
        // return printf("%%x = '%x'\n", $n); // hexadecimal representation (lower-case)
        // return printf("%%X = '%X'\n", $n); // hexadecimal representation (upper-case)
    }
    // quoted_printable_decode — Convert a quoted-printable string to an 8 bit string
    // quoted_printable_encode — Convert a 8 bit string to a quoted-printable string
    function quoted_printable_encode() {
        $encoded = quoted_printable_encode('Möchten Sie ein paar Äpfel?');

        return ($encoded);
        // return (quoted_printable_decode($encoded));
    }
    // quotemeta — Quote meta characters
    function quotemeta()    {
        // return (quotemeta('PHP is a popular scripting language. Fast, flexible, and pragmatic.'));
        return quotemeta(". \ + * ? [ ^ ] ( $ )");
    }
    // rtrim — Strip whitespace (or other characters) from the end of a string
    function rtrim()    {
        $text = "\t\tThese are a few words :) ...  ";
        $binary = "\x09Example string\x0A";
        $hello  = "Hello World";

        $trimmed = rtrim($text);
        // return ($text . '=>' . $trimmed);

        $trimmed = rtrim($text, " \t.");
        // return ($text . '=>' . $trimmed);

        $trimmed = rtrim($hello, "Hdle");
        // return ($hello . '=>' . $trimmed);

        // trim the ASCII control characters at the end of $binary
        // (from 0 to 31 inclusive)
        $clean = rtrim($binary, "\x00..\x1F");
        return ($binary . '=>' . $clean);
    }
    // setlocale — Set locale information
    function setlocale()    {
        // setlocale(LC_ALL, "en_US.UTF-8");
        // setlocale(LC_ALL, "nb_NO.utf8"); // Output: C
        // setlocale(LC_ALL,"US"); // Output : C
        // setlocale(LC_ALL,NULL); // Output: 502 Bad Gateway
        return setlocale(LC_ALL, 0);
    }
    // sha1_file — Calculate the sha1 hash of a file
    // sha1 — Calculate the sha1 hash of a string
    // similar_text — Calculate the similarity between two strings
    // soundex — Calculate the soundex key of a string
    function soundex(){ 
        // return soundex("Euler"); // E460
        // return soundex("Gauss"); // G200
        // return soundex("Hilbert"); // H416
        // return soundex("Knuth"); // K530
        // return soundex("Lloyd"); // L300
        return soundex("Lukasiewicz"); // L222
    }
    // sprintf — Return a formatted string
    // sscanf — Parses input from a string according to a format
    // str_contains — Determine if a string contains a given substring
    // str_ends_with — Checks if a string ends with a given substring
    // str_getcsv — Parse a CSV string into an array
    // str_ireplace — Case-insensitive version of str_replace
    // str_pad — Pad a string to a certain length with another string
    // str_repeat — Repeat a string
    // str_replace — Replace all occurrences of the search string with the replacement string
    // str_rot13 — Perform the rot13 transform on a string
    // str_shuffle — Randomly shuffles a string
    // str_split — Convert a string to an array
    // str_starts_with — Checks if a string starts with a given substring
    // str_word_count — Return information about words used in a string
    // strcasecmp — Binary safe case-insensitive string comparison
    // strchr — Alias of strstr
    // strcmp — Binary safe string comparison
    // strcoll — Locale based string comparison
    // strcspn — Find length of initial segment not matching mask
    // strip_tags — Strip HTML and PHP tags from a string
    // stripcslashes — Un-quote string quoted with addcslashes
    // stripos — Find the position of the first occurrence of a case-insensitive substring in a string
    // stripslashes — Un-quotes a quoted string
    // stristr — Case-insensitive strstr
    // strlen — Get string length
    // strnatcasecmp — Case insensitive string comparisons using a "natural order" algorithm
    // strnatcmp — String comparisons using a "natural order" algorithm
    // strncasecmp — Binary safe case-insensitive string comparison of the first n characters
    // strncmp — Binary safe string comparison of the first n characters
    // strpbrk — Search a string for any of a set of characters
    // strpos — Find the position of the first occurrence of a substring in a string
    // strrchr — Find the last occurrence of a character in a string
    // strrev — Reverse a string
    // strripos — Find the position of the last occurrence of a case-insensitive substring in a string
    // strrpos — Find the position of the last occurrence of a substring in a string
    // strspn — Finds the length of the initial segment of a string consisting entirely of characters contained within a given mask
    // strstr — Find the first occurrence of a string
    // strtok — Tokenize string
    // strtolower — Make a string lowercase
    // strtoupper — Make a string uppercase
    // strtr — Translate characters or replace substrings
    // substr_compare — Binary safe comparison of two strings from an offset, up to length characters
    // substr_count — Count the number of substring occurrences
    // substr_replace — Replace text within a portion of a string
    // substr — Return part of a string
    // trim — Strip whitespace (or other characters) from the beginning and end of a string
    // ucfirst — Make a string's first character uppercase
    // ucwords — Uppercase the first character of each word in a string
    // utf8_decode — Converts a string from UTF-8 to ISO-8859-1, replacing invalid or unrepresentable characters
    // utf8_encode — Converts a string from ISO-8859-1 to UTF-8
    // vfprintf — Write a formatted string to a stream
    // vprintf — Output a formatted string
    // vsprintf — Return a formatted string
    // wordwrap — Wraps a string to a given number of characters
    function wordwrap() {
        $text = "A very long woooooooooooord. The quick brown fox jumped over the lazy dog.";
        $newtext = wordwrap($text, 20, "<br />\n");

        return $newtext;
    }



    function missing_route($parameter)    {
        return 'in function missing_route()';
    }

    function checkroute()   {
        $route = Route::current(); // Get the current route object
        $name = Route::currentRouteName(); // Get the name of the current route
        $action = Route::currentRouteAction(); // Get the action associated with the current route

        // return $route . ' | ' . $name . ' | ' . $action;
        return $name;
        // return $action;
    }

    function post_laravel(Request $request) 
    // : RedirectResponse
    {
        // return $request->input('first_name');
        // return $request->first_name;
        // return $request['first_name'];
        
        // http request
        // return $request->path(); 
        // return $request->url(); 
        // return $request->fullUrl(); // url and fullUrl will return url without query
        // return $request->fullUrlWithQuery(['type' => 'phone']);
        // return $request->fullUrlWithoutQuery(['type']);

        // return $request->host();
        // return $request->httpHost();
        // return $request->schemeAndHttpHost();

        // return $request->method();
        // if ($request->hasHeader('X-Header-Name')) {
        //     return 'hi';
        // }
        // else    {
        //     return 'hello';
        // }
        // return $request->header('X-Header-Name', 'default');
        // return $request->bearerToken();
        // return $request->ip();
        // return $request->getAcceptableContentTypes();
        // if ($request->accepts(['text/html', 'application/json'])) {
        //     return 'accept text/html application/json';
        // }
        // else    {
        //     return 'not accept';
        // }
        // return $request->prefers(['text/html', 'application/json']); // choose mana yang match dengan content types yang digunakan
        // if ($request->expectsJson()) {
        //     return 'expectJson';
        // }
        // else    {
        //     return 'not expectJson';
        // }

        // dd($request->all());
        // dd($request->collect()); // retrieve all of the incoming request's input data as a collection
        // dd($request->input()); // also all

        // dd($request->query('token')); // not value, query string is form url
        // dd($request->query());
        // dd($request->boolean('bool'));  // not different with $request->bool

        // return $request->date . ' || ' . $request->date('date');

        // $input = $request->only('first_name', 'last_name');
        // $input = $request->except('first_name', 'last_name');
        // return $input;

        // dd($request->has('last_name'));
        // dd($request->has(['first_name', 'last_name']));
        // dd($request->hasAny(['name', 'last_name']));

        // $request->whenHas('first_name', function ($input) { // not working
        //     $first_name = $input;
        //     return "The 'first_name' value is present: $first_name";
        // }, function () {
        //     return "The 'first_name' value is not present.";
        // });

        // if ($request->filled('first_name')) {
        //     return 'first_name filled';
        // }
        // else    {
        //     return 'first_name not filled';
        // }

        // if ($request->anyFilled(['first_name', 'email'])) {
        //     return 'first_name AND email filled'; 
        // }
        // else    {
        //     return 'first_name OR email not filled ';
        // }

        // $hi = 'huhu'; 
        // $request->whenFilled('first_name', function (string $input) { // not working ALSO even filled
        //     $hi = 'hi';
        // });
        // return $hi; // always huhu
        
        // if ($request->missing('first_name')) {
        //     return 'missing first_name';
        // }
        // else    {
        //     return 'not missing first_name';
        // }

        // $request->whenMissing('name', function (array $input) { // not working
        //     return $input;
        // }, function () {
        //     return 'huhu';
        // });

        // $request->merge(['votes' => 0]);
        // $request->mergeIfMissing(['votes' => 0]);
        // $votes = $request->input('votes');
        // return $request;

        // $request->flash(); // work but not 'old'
        // return ($request->old('first_name'));

        // $value = $request->cookie('first_name'); // return null do no why
        // dd($value);

        // $path = $request->file->path();
        // $extension = $request->file->extension();
        // return $path . ' ' . $extension;

        // return $request->file('file');
        // if($request->hasFile('file'))   {
        //     $path = $request->file->path();
        //     $extension = $request->file->extension();

        //     $path = $request->file->store('images'); // storing file - saved in storage/app/images

        //     return 'path:' . $path . ' || extension:' . $extension;
        //     // return 'has file';
        // }
        // else return 'no file';

        // if ($request->file('file')->isValid()) {
        //     return 'valid';
        // }

        // return redirect()->route('example'); // must return redirect if declare return :RedirectResponse

        $data = $request->session()->all();
        return $data;
    }

    function actionController() {
        return 'huhu';
    }

    function learnVue6() {
        $str = 'try';
        $str2 = 'try lagiiiii';

        $data = [
            'str' => $str,
            'str2' => $str2,
        ];
        
        // Convert the associative array to an object
        $strObject = (object)$data;

        return inertia('LearnVue7', compact('str', 'strObject'));
    }
}
