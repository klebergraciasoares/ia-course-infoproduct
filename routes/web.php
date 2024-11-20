<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
//use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\CompanyIndex;
use App\Http\Livewire\CustomerIndex;
use App\Http\Livewire\ProductIndex;
use App\Http\Livewire\OrderIndex;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('login', Login::class)->name('login');
//Route::get('login', [Login::class, 'login']);
Route::get('login', [Login::class, 'login'])->name('login');


//Route::get('register', Register::class)->name('register');
Route::get('register', [Register::class, 'register']);


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //Route::get('companies', CompanyIndex::class)->name('companies');
    Route::get('companies', [CompanyIndex::class, 'companies']);

    //Route::get('customers', CustomerIndex::class)->name('customers');
    Route::get('customers', [CustomerIndex::class, 'customers']);

    //Route::get('products', ProductIndex::class)->name('products');
    Route::get('products', [ProductIndex::class, 'products']);

    //Route::get('orders', OrderIndex::class)->name('orders');
    Route::get('orders', [Register::class, 'regisorderster']);
});


