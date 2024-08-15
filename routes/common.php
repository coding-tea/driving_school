<?php


use App\Http\Controllers\LangController;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('language/{locale}', LangController::class)->name('setLang');





Route::prefix('social-media')->name('socialMedia.')
    ->controller(\App\Http\Controllers\SocialMediaController::class)
    ->group(function () {
        Route::get('facebook', 'facebook')->name('facebook');
        Route::get('twitter', 'twitter')->name('twitter');
        //        Route::get('linkedin', 'linkedin')->name('linkedin');
        Route::get('instagram', 'instagram')->name('instagram');
    });

Route::post('uploads/images/upload', function (Request $request) {
    $image = app(ImageService::class)->saveImage($request->file('upload'), 'wysiwyg/');
    $fullPath = stream_image_from_uploads($image->getPath());
    return response()->json([
        'filename' => basename($fullPath),
        'uploaded' => 1,
        'url' => $fullPath,
    ]);
})->name('uploads.images');


Route::get('uploads/images/{path?}', function (Request $request, ImageService $imageService, $path = 'path') {
    return $imageService->streamImageFromStorage($path, $request->get('default'));
})
    ->where('path', '.*')
    ->name('stream.image_from_upload');





Route::get('download/{path?}', function ($path) {
    $filePath = storage_path('app/export/' . $path);
    return response()->download($filePath);
})
    ->where('path', '.*')
    ->name('download.files');
