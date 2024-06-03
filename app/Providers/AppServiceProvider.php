<?php

namespace App\Providers;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'Blog',
                'url' => 'admin/blm  og',
            ]);

            // $subMenu = Category::all();

            // foreach($subMenu as $menu){
            //     $event->menu->addIn('categorias', [
            //         'text' => $menu->name,
            //         'url' => '#',
            //     ]);
            // }
        });
    }
}
