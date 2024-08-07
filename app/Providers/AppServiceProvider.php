<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MatanYadaev\EloquentSpatial\Objects\Geometry;

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
        Geometry::macro('pointToArray', function (): array {
            /** @var Geometry $this */
            $coordinates = [
                $this->latitude,
                $this->longitude,
            ];
            return [
                "type" => "Point",
                "coordinates" => $coordinates,
            ];
        });
    }
}
