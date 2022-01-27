<?php
use Illuminate\Support\Facades\Route;




Route::get('{any}', function() {
    return view('admin');
})->where('any', '.*');



//"@casl/ability": "^5.4.3",
//        "@casl/vue": "^1.2.3",
//        "ckeditor": "^4.12.1",
//        "laravel-vue-pagination": "^2.3.1",
//        "nprogress": "^0.2.0",
//        "select2": "^4.1.0-rc.0",
//        "vue-template-compiler": "^2.6.12",
//        "vue-toast-notification": "^0.6.2",
//        "vuex": "^3.6.2",
//        "x-axios-progress-bar": "^1.2.2"