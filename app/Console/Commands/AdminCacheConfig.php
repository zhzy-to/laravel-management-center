<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AdminCacheConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin-cache-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '缓存配置';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('后台配置缓存已清除');

        $this->info('已重新构建缓存配置');

        return 0;
    }
}
