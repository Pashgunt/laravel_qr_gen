<?php

namespace App\Console\Commands;

use App\Filters\FeedbackFilter as FiltersFeedbackFilter;
use App\Filters\FeedbackFilterResultFilter;
use App\Models\FeedbackFilter;
use App\QR\Repositories\FeedbackFilterRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ClearHashFeedbackFilterResult extends Command
{
    protected $signature = 'app:clear-hash-feedback-filter-result';

    protected $description = 'clear long ago created hash feedback filter result';

    public function handle(): void
    {
        app(FeedbackFilterRepository::class)->updateFeedbackFilterResult(
            FeedbackFilter::filter(new FeedbackFilterResultFilter(), [
                'created_at_least' => Carbon::now()->subDays(2),
                'hash_empty' => '',
            ]),
            [
                'hash' => '',
            ]
        );
    }
}
