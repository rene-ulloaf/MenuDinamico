<?php

namespace App\Console\Commands;

use Log;
use Illuminate\Console\Command;

class TBcmd_limpiar extends Command {
    protected $signature = 'TBcmd:limpiar';
    protected $description = 'Limpia todo el cache del proyecto';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        Log::info("--Inicio Limpiar--");

        Log::info("-cache:clear-");
        echo "cache:clear";
        $resp = \Artisan::call('cache:clear');
        echo "[" . $resp . "]";
        Log::info("[" . $resp . "]");
        Log::info("-fin cache:clear-");

        Log::info("-view:clear-");
        echo "view:clear";
        $resp = \Artisan::call('view:clear');
        echo "[" . $resp . "]";
        Log::info("[" . $resp . "]");
        Log::info("-fin view:clear-");

        Log::info("-route:cache-");
        echo "route:cache";
        $resp = \Artisan::call('route:cache');
        echo "[" . $resp . "]";
        Log::info("[" . $resp . "]");
        Log::info("-fin route:cache-");

        Log::info("-config:cache-");
        echo "config:cache";
        $resp = \Artisan::call('config:cache');
        echo "[" . $resp . "]";
        Log::info("[" . $resp . "]");
        Log::info("-fin config:cache-");

        Log::info("-optimize-");
        echo "optimize";
        $resp = \Artisan::call('optimize');
        echo "[" . $resp . "]";
        Log::info("[" . $resp . "]");
        Log::info("-fin optimize-");
        
        Log::info("--Fin Limpiar--");
    }
}