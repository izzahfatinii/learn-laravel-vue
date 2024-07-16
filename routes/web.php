<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Inertia\Inertia;

use App\Http\Controllers\StringController;
use App\Http\Controllers\MathController;
use App\Http\Controllers\ArrayController;
use App\Http\Controllers\InvokeController;

use Illuminate\Http\Request;


use App\Models\User;

use App\Http\Middleware\EnsureTokenIsValid;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Service Container & Provider
// dd(app()->make('Hello'));
// cache()->get('abc');
// dd(app());

//Cache Facade
// Cache::set('name', 'Izzah');
// dd(Cache::get('name'));

Route::redirect('/', '/string/substr'); // 302
// Route::redirect('/here', '/there', 301); // 301 Moved Permanently - need to clear cache
// Route::permanentRedirect('/here', '/there');

Route::get('learn-laravel', function () {
    return Inertia::render('LearnLaravel', ['name' => 'Taylor']);
});
Route::get('learn-laravel2', function () { // learn to use api
    return Inertia::render('LearnLaravel2');
});
// Route::post('post-learn-laravel', [StringController::class, 'post_laravel'])->name('post_laravel')
// ->middleware('ensure.token.valid');
// Route::post('post-learn-laravel', [StringController::class, 'post_laravel'])->name('post_laravel')
// ->middleware(EnsureTokenIsValid::class);
Route::middleware([EnsureTokenIsValid::class])->group(function () {
    Route::post('post-learn-laravel', [StringController::class, 'post_laravel'])->name('post_laravel');

    // Route::post('post-learn-laravel', [StringController::class, 'post_laravel'])->name('post_laravel')
    // ->withoutMiddleware([EnsureTokenIsValid::class]);
});

Route::get('/example', InvokeController::class)->name('example');
Route::post('/example', InvokeController::class);

Route::get('/reponse', function () {
    // return [1, 2, 3];
    // return response()->json([
    //     'name' => 'Abigail',
    //     'state' => 'CA',
    // ]);

    // $pathToFile = storage_path('app/images/483ndeDI9SmyOJeqFjxKGfm6sOilnDPJqLhYZ5gT.jpg');
    // return response()->download($pathToFile);
    // $pathToFile = storage_path('app/images/483ndeDI9SmyOJeqFjxKGfm6sOilnDPJqLhYZ5gT.jpg');
    // return response()->file($pathToFile, [
    //     'Content-Disposition' => 'inline; filename="483ndeDI9SmyOJeqFjxKGfm6sOilnDPJqLhYZ5gT.jpg"',
    // ]); // can only choose either to response display (file) or download  

    return response()->caps('Helllllloooooo');

});
Route::get('reponse/home', function () {
    // return response('Hello World', 200); // light colour do not why
    // return response('Hello World', 200)
    //     ->header('Content-Type', 'text/plain');

    $content = "Hello, World!";
    $type = "text/plain"; // Content type

    // Create a response with headers and content
    return response($content)
        ->header('Content-Type', $type)
        ->header('X-Header-One', 'Header Value')
        ->header('X-Header-Two', 'Header Value');
});

Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () { // works but do not know cache.headers doing
    Route::get('/privacy', function () {
        return response('privacy');
    });

    Route::get('/terms', function () {
        return response('terms');
    });
});

Route::get('/set-cookie', function () {
    // Cookie::queue(Cookie::make('name', 'huhuhuhuhuu', 30)); // define cookie value

    // return redirect('/get-cookie');
    return response('Hello World')->cookie(
        'name', 'hahahah', 30
    );
});
Route::get('/get-cookie', function (Request $request) { // get cookie value
    $cookieValue = $request->cookie('name'); 
    return 'Cookie Value: ' . $cookieValue;
});

Route::get('actionController2', function ()  { // actionController2 -> actionController
    return redirect()->action([StringController::class, 'actionController']); // works tapi macam bazir sebab boleh je pakai redirect biase
});
Route::get('actionController', [StringController::class, 'actionController']); // this still needed

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    Route::get('/users/{user}', function (User $user) {
        $userName = $user->name;
        
        return "User Name: $userName";
    })->name('users.profile');
});

Route::prefix('string')->group(function () {
    //Main code
    Route::get('substr/{code?}', [StringController::class, '_substr'])->name('s.substr');
    
    Route::get('hi', [StringController::class, 'index']);
    
    //New Practice
    Route::get('addcslashes', [StringController::class, 'addcslashes']);
    Route::get('addslashes', [StringController::class, 'addslashes']);
    Route::get('bin2hex', [StringController::class, 'bin2hex']);
    Route::get('chop', [StringController::class, 'chop']);
    Route::get('chr', [StringController::class, 'chr']);
    Route::get('chunk_split', [StringController::class, 'chunk_split']);
    Route::get('convert_uudecode', [StringController::class, 'convert_uudecode']);
    Route::get('convert_uuencode', [StringController::class, 'convert_uuencode']);
    Route::get('explode', [StringController::class, 'explode']);
    Route::get('fprintf', [StringController::class, 'fprintf']);
    Route::get('get_html_translation_table', [StringController::class, 'get_html_translation_table']);
    Route::get('hebrev', [StringController::class, 'hebrev']);
    Route::get('hex2bin', [StringController::class, 'hex2bin']);
    Route::get('htmlentities', [StringController::class, 'htmlentities']);
    Route::get('html_entity_decode', [StringController::class, 'html_entity_decode']);
    Route::get('htmlspecialchars', [StringController::class, 'htmlspecialchars']);
    Route::get('htmlspecialchars_decode', [StringController::class, 'htmlspecialchars_decode']);
    Route::get('implode', [StringController::class, 'implode']);
    Route::get('join', [StringController::class, 'join']);
    Route::get('lcfirst', [StringController::class, 'lcfirst']);
    Route::get('levenshtein', [StringController::class, 'levenshtein']);
    Route::get('localeconv', [StringController::class, 'localeconv']);
    Route::get('ltrim', [StringController::class, 'ltrim']);
    Route::get('md5_file', [StringController::class, 'md5_file']);
    Route::get('md5', [StringController::class, 'md5']);
    Route::get('metaphone', [StringController::class, 'metaphone']);
    Route::get('nl_langinfo', [StringController::class, 'nl_langinfo']);
    Route::get('nl2br', [StringController::class, 'nl2br']);
    Route::get('number_format', [StringController::class, 'number_format']);
    Route::get('ord', [StringController::class, 'ord']);
    Route::get('parse_str', [StringController::class, 'parse_str']);
    Route::get('print', [StringController::class, 'print']);
    Route::get('printf', [StringController::class, 'printf']);
    Route::get('quoted_printable_encode', [StringController::class, 'quoted_printable_encode']);
    Route::get('quotemeta', [StringController::class, 'quotemeta']);
    Route::get('rtrim', [StringController::class, 'rtrim']);
    Route::get('setlocale', [StringController::class, 'setlocale']);
    Route::get('soundex', [StringController::class, 'soundex']);
    Route::get('wordwrap', [StringController::class, 'wordwrap']);
});

Route::post('code', [StringController::class, 'testcode'])->name('testcode');

Route::prefix('math')->group(function () {
    Route::get('abs/{code?}', [MathController::class, '_abs'])->name('m.abs');
});

Route::prefix('array')->group(function () {
    Route::get('array_change_key_case', [ArrayController::class, 'array_change_key_case']);
    Route::get('array_chunk', [ArrayController::class, 'array_chunk']);
    Route::get('array_column', [ArrayController::class, 'array_column']);
    Route::get('array_combine', [ArrayController::class, 'array_combine']);
    Route::get('array_count_values', [ArrayController::class, 'array_count_values']);
    Route::get('array_diff_assoc', [ArrayController::class, 'array_diff_assoc']);
});
// Route::prefix('array')->controller(ArrayController::class)->group(function () {
//     Route::get('array_change_key_case', 'array_change_key_case');
//     Route::get('array_chunk', 'array_chunk');
//     Route::get('array_column', 'array_column');
//     Route::get('array_combine', 'array_combine');
//     Route::get('array_count_values', 'array_count_values');
//     Route::get('array_diff_assoc', 'array_diff_assoc');
// });
 
// Route::get('missing/{parameter}', [StringController::class, 'missing_route']) // Not working
//         ->name('missing.parameter')
//         ->missing(function (Request $request) {
//             return 'in route ->missing()';
//         });

Route::fallback(function (Request $request) { //function - will run when not route define in here
    return 'This page does not exist.';
});

Route::get('checkroute', [StringController::class, 'checkroute'])->name('checkroute.name');

Route::get('learn-vue', function () {
    return Inertia::render('LearnVue');
})->name('learnvue');
Route::get('learn-vue2', function () {
    return Inertia::render('LearnVue2');
})->name('learnvue2');
Route::get('learn-vue3', function () {
    return Inertia::render('LearnVue3');
})->name('learnvue3');
Route::get('learn-vue4', function () {
    return Inertia::render('LearnVue4');
})->name('learnvue4');
Route::get('learn-vue5', function () {
    return Inertia::render('LearnVue5');
})->name('learnvue5');
Route::get('learn-vue6', [StringController::class, 'learnVue6']);

Route::get('cdn-vue', function () {
    return view('cdnvue');
})->name('cdnvue');


Route::get('strpos', function ()    {
    return strpos("I love php, I love php too!","php");
});