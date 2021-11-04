<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChangeBackground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:background';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar el fondo de pantalla de los libros';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//       return Http:: redirect()->to('/es/dashboard');
    }

    public function changeBackground()
    {
    }
}
