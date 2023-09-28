<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Character;
use App\Models\ChampSpells;
use Illuminate\Support\Facades\Http;

class UpdateSpells extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-spells';

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
        $champions = Character::all();
        foreach ($champions as $name => $champions) {
            $character = Http::get('https://ddragon.leagueoflegends.com/cdn/13.18.1/data/pl_PL/champion/'.$champions->name.'.json');
            //dd($character);

            if ($character->failed()) {
                continue;
            }

            $character = $character->json()['data'][$champions->name];
            //dd($character['spells']);
            ChampSpells::updateOrCreate(
                ['id' => $champions['key']],
                [
                    'ChampName' => $character['name'],
                    'SpellName' => data_get($character['spells'], '*.name'),
                    'picture' =>  data_get($character['spells'], '*.id'),
                ],
            );
        }
    }
}
