<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class FilamentInfoWidget extends \Filament\Widgets\FilamentInfoWidget
{
    // protected static string $view = 'filament.widgets.filament-info-widget';

    protected string|int|array $cols;

    protected string $ignoreAfter;

    public function __construct() {
        //
        $this->columnSpan = [
            'md' => 6,
            'xl' => 6,
        ];

        $this->cols = 'full';
    }
}
