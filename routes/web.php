<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMessageController;
use App\Http\Controllers\LetterMakerController;

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


Route::get('/', function(){
    return redirect("login");
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/get-message', [SendMessageController::class, 'getMessageFromChatGpt'])->name('get.message');

    Route::middleware('adminmiddleware')->group(function () {
        Route::get('dashboard',[MessagesController::class, 'index'])->name('dashboard');
        Route::get('message/create',[MessagesController::class, 'create'])->name('message.create');
        Route::post('message/create',[MessagesController::class, 'store'])->name('message.store');
        Route::get('message/edit/{id}',[MessagesController::class, 'edit'])->name('message.edit');
        Route::patch('message/update/{id}',[MessagesController::class, 'update'])->name('message.update');
        Route::delete('message/delete/{id}',[MessagesController::class, 'destroyMessage'])->name('message.delete');
        Route::get('users',[MessagesController::class, 'users'])->name('users');
        Route::delete('user/delete/{id}',[MessagesController::class, 'destroyUser'])->name('user.delete');
        Route::patch('message/send/{id}',[MessagesController::class, 'send'])->name('message.send');
        Route::patch('message/regenerate/{id}',[MessagesController::class, 'regenerate'])->name('message.regenerate');
        Route::patch('message/sendforreview/{id}',[MessagesController::class, 'sendForReview'])->name('message.sendforreview');
        Route::get('generatePDF',[LetterMakerController::class, 'index'])->name('generate.warning');
    });

});


Route::get('/text-diff', function () {

        // Old and new texts for demonstration
        $oldText = "The quick brown reddish ugly fox jumps over the lazy dog.";
        $newText = "The quick red fox jumps over the fast moving dog that was running as fast as possible.";
    
        // Compute the differences using Text_Diff
        $diff = new Text_Diff('auto', array(explode(' ', $oldText), explode(' ', $newText)));
        $changes = $diff->getDiff();
    
        $renderer = new Text_Diff_Renderer_inline(
            array(
                'ins_prefix' => '<ins class="m-1 text-green-600">',
                'ins_suffix' => '</ins>',
                'del_prefix' => '<del class="m-1 text-red-600">',
                'del_suffix' => '</del>',
            )
        );

        $changes = $renderer->render($diff);

         return view('welcome', compact('changes'));
});
    

require __DIR__.'/auth.php';
