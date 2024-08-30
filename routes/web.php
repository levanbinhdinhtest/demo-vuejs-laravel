<?php

use Illuminate\Support\Facades\Route;

Route::view("/{any}","app")->where("any",".*");
//sd vue route de dinh tuyen url trong trang web cho k dung route cua laravel