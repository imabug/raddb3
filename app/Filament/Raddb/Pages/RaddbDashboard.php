<?php

namespace App\Filament\Raddb\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class RaddbDashboard extends BaseDashboard
{
    protected int | string | array $columnSpan = 'full';
    
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getColumns(): int | array
    {
        return 1;
    }
}
