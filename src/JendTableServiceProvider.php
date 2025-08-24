<?php

namespace KimNopal\JendTable;

use Illuminate\Support\ServiceProvider;
use KimNopal\JendTable\Components\Table;
use Livewire\Livewire;

class JendTableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'jendtable');

        Livewire::component('jendtable:table', Table::class);
    }

    public function register(): void
    {
        // Registering code
    }
}
