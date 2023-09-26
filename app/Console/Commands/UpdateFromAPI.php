<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Image;
use App\Helper\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateFromAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-from-a-p-i';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $champions = Http::get('https://ddragon.leagueoflegends.com/cdn/13.18.1/data/pl_PL/champion.json');

        foreach ($champions->json('data') as $name => $champions) {
            Character::updateOrCreate(
                ['id' => $champions['key']],
                [
                    'name' => $champions['name'],
                    'partype' => $champions['partype'],
                    'stats' => $champions['stats']['attackrange'],
                    'tags' => $champions['tags'],
                    'difficulty' => $champions['info']['difficulty'],
                    'ChampPicture' => $champions['image']['full'],
                ],
            );
        }
    }
}
