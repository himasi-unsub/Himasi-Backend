<?php
namespace App\Jobs;

use Bytexr\QueueableBulkActions\Filament\Actions\ActionResponse;
use Bytexr\QueueableBulkActions\Jobs\BulkActionJob;

class ImportPesertaMakrabBulkActionJob implements BulkActionJob
{
    protected function action($record, ?array $data): ActionResponse
    {

        return ActionResponse::make()
            ->success();
    }
}
