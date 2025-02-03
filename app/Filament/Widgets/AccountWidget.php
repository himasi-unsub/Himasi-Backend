<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AccountWidget extends \Filament\Widgets\AccountWidget
{
    // protected static string $view = 'filament.widgets.account-widget';

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
