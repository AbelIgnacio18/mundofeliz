<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Aula;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Pasar los menús a todas las vistas que incluyan 'partials.aside'
        View::composer('partials.aside', function ($view) {
            $menus = Aula::orderBy('id')->get();
            $view->with('menus', $menus);
        });
    }
}
