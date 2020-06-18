<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'etudiant' => \App\Etudiant::class,
            'etudiantpfe' => \App\EtudiantPFE::class,
            'etudiantmp2' => \App\EtudiantMP2::class,
            'etudiantmr2' => \App\EtudiantMR2::class,
            'etudiantregulier' => \App\EtudiantRegulier::class,
        ]);
    }
}
