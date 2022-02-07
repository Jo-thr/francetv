<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Helpers\MetaMediaFetcher;

class FetchMetaMediaCommand extends Command
{
    protected $signature = 'ftv:metamedia:fetch';
    protected $description = 'Fetch last 50 meta medias';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        MetaMediaFetcher::fetch(5);
        $this->info('MetaMedia fetching ok');
        return 0;
    }
}
