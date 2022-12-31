<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\BrandController;

use Illuminate\Support\Facades\Route;

// Route::get('/admin/home',[HomeController::class,'admin'])->name('admin.home')->middleware('is_admin');
Route::get('/admin-login',[LoginController::class,'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function(){
    Route::get('admin/home',[AdminController::class,'admin'])->name('admin.home');
    Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');

    // Category routes
    Route::group(['prefix'=>'category'],function(){
        Route::get('/',[CategoryController::class,'index'])->name('category.index');
        Route::post('/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
        Route::get('/edit/{id}',[CategoryController::class,'edit']);
        Route::post('update/',[CategoryController::class,'update'])->name('category.update');
    });

    // Subcategory routes
    Route::group(['prefix'=>'subcategory'],function(){
        Route::get('/',[SubcategoryController::class,'index'])->name('subcategory.index');
        Route::post('/store',[SubcategoryController::class,'store'])->name('subcategory.store');
        Route::get('/delete/{id}',[SubcategoryController::class,'delete'])->name('subcategory.delete');
        Route::get('/edit/{id}',[SubcategoryController::class,'edit']);
        Route::post('update/',[SubcategoryController::class,'update'])->name('subcategory.update');
    });

    // Childcategory routes
    Route::group(['prefix'=>'childcategory'],function(){
        Route::get('/',[ChildcategoryController::class,'index'])->name('childcategory.index');
        Route::post('/store',[ChildcategoryController::class,'store'])->name('childcategory.store');
        Route::get('/delete/{id}',[ChildcategoryController::class,'destroy'])->name('childcategory.delete');
        Route::get('/edit/{id}',[ChildcategoryController::class,'edit']);
        Route::post('update/',[ChildcategoryController::class,'update'])->name('childcategory.update');
    });

    // Brand routes
    Route::group(['prefix'=>'brand'],function(){
        Route::get('/',[BrandController::class,'index'])->name('brand.index');
        Route::post('/store',[BrandController::class,'store'])->name('brand.store');
        // Route::get('/delete/{id}',[ChildcategoryController::class,'destroy'])->name('childcategory.delete');
        // Route::get('/edit/{id}',[ChildcategoryController::class,'edit']);
        // Route::post('update/',[ChildcategoryController::class,'update'])->name('childcategory.update');
    });
});