<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Helpers\MetaMediaFetcher;

class RebuildMetaMediaCommand extends Command
{
    protected $signature = 'ftv:metamedia:rebuild';
    protected $description = 'Rebuild meta medias database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        MetaMediaFetcher::fetch(50, true);
        $this->info('MetaMedia rebuild ok');
        return 0;
    }
}
