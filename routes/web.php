<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LogController,
    UseController,
    GroController
};

/*
|--------------------------------------------------------------------------
| Web Routes
@@ -14,4 +17,5 @@
*/
Route::fallback(function () {
    abort(404);
});


    Route::get('/login', [LogController::class, 'renderA01'])->name('render-log-a01')->middleware('clearcache');
    Route::post('/login', [LogController::class, 'loginA01'])->name('login-a01');
    Route::get('/logout', [LogController::class, 'logout'])->name('logout-a01');

    Route::prefix('user')->group(function () {
        Route::group(['middleware' => ['auth']], function () {
            Route::get('/', [UseController::class, 'index'])->name('render-use-a01')->middleware('clearcache');
            Route::get('/search', [UseController::class, 'handleSearchA01'])->name('handle-search-a01');
            Route::get('/AddEditDelete', [UseController::class, 'renderAddA02'])->name('render-use-a02')->middleware('clearcache');
            Route::post('/csvExport', [UseController::class, 'csvExportA01'])->name('csv-export-a01');
            Route::post('/AddEditDelete', [UseController::class, 'registerA02'])->name('register-a02');
            Route::get('/AddEditDelete/update/{id}', [UseController::class, 'renderUserEditA02'])->name('render-use-info-a02')->middleware('clearcache');
            Route::post('/AddEditDelete/update/{id}',[UseController::class, 'userUpdateA02'])->name('user-update-a02');
            // Route::post('/AddEditDelete/directorUpdate/{id}',[UseController::class, 'userDirectorUpdateA02'])->name('user-director-update-a02');
            Route::delete('/AddEditDelete/delete/{id}',[UseController::class, 'userDeleteA02'])->name('user-delete-a02');
        });
    });

    Route::prefix('group')->group(function () {
        Route::group(['middleware' => ['auth', 'checkrole:director']], function () {
            Route::get('/', [GroController::class, 'renderA01'])->name('render-gro-a01')->middleware('clearcache');
            Route::post('/csvImport', [GroController::class, 'csvImportA01'])->name('csv-import-a01');
        });
    });


