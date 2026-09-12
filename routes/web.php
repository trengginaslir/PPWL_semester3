<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get ('/halo-dunia', function(){
//     return ('<h1>Halo dunia</h1>');
// });

// Route::get('/halo/{nama}', function($nama){
//     return ('<h1>Halo ' . $nama . '</h1>');
// });

// Route::get('/halo/{nama?}', function($nama = 'Tanpa nama'){
//     return ('<h1>Halo ' . $nama . '</h1>');
// });

// Route::redirect('/lama','/baru');
// Route::get('/baru', function(){
//     return ('<h1>Ini halaman baru</h1>');
// });

// Route::get('/home', function() {
//     return view('home');
// })->name('home');

// Route::get('/about', function() {
//     return view('about');
// })->name('about');

// Route::get('/hallo/{nama}', function($nama) {
//     return 'Hallo ' . $nama;
// })->name('hallo');

// Route::prefix('portfolio')->group(function() {
//     Route::get('/', fn() => view('portfolio.home'))->name('portfolio.home');
//     Route::get('/about', fn() => view('portfolio.about'))->name('portfolio.about');
//     Route::get('/projects', fn() => view('portfolio.projects'))->name('portfolio.projects');
// });

// Route::get('/halo-dunia', function() {
//     return view('halo_dunia');
// });

// Route::get('/portfolio', function() {
//     return view('portfolio.home');
// });

// Route::get('/profil', function() {
//     $nama = 'Trengginas';
//     $umur = 19;
//     $kota = 'Depok';
//     return view('profil', compact('nama', 'umur',
// 'kota'));
// });

// Route::get('/halo-blade', function() {
//     return view('halo', ['data' => 'Contoh data']);
// });

// Route::get('/test-blade', function() {
//     return view('test-blade', ['umur' => 20]);
// });

// Route::get('/test-foreach', function() {
//     return view('test-foreach', [
//         'projects' => [], 
//     ]);
// });


Route::get('/home', function() {
    return view('home');
})->name('home');

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/', fn() => view('home'))->name('home');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/education', fn() => view('education'))->name('education');
Route::get('/projects', fn() => view('projects'))->name('projects');