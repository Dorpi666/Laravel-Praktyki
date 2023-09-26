<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Image;
use App\Helper\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\CharacterAverage;
use App\Models\CharacterScore;
use App\Models\Loldle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class CharacterController extends Controller
{
    use ImageManager;


    public function index()
    {
        
        
        $characters = Character::all();
        //$imageUrlAwatar = $characters->image_url_awatar;
        $characters = Character::paginate(15);
        
       
        return view('character.index', [
            
        'characters' => $characters,
        //'imageUrlAwatar' => $imageUrlAwatar,
    ]);

       // return view('character.index');
    }
    
    public function rotation()
    {
        
        
        $rotations = Http::withHeader('X-Riot-Token', 'RGAPI-a54dde06-dff5-4560-82f4-239b2830b741')->get('https://eun1.api.riotgames.com/lol/platform/v3/champion-rotations');
        $champions = Http::get('https://ddragon.leagueoflegends.com/cdn/13.18.1/data/pl_PL/champion.json');
        //dd($rotations);
        $rotaionChampions = collect();
        foreach ($champions->json('data') as $name => $champions)
        {
            if(in_array($champions['key'], $rotations['freeChampionIdsForNewPlayers']) )
            {
                $rotaionChampions -> add($champions['name']);
            }
            else {
            }
        }
        return view('character.RiotAPI', [ 'champion' => $rotaionChampions]);
    }

    public function ShowRotationChampion($value)
    {
        
        $character = Character::where('name', $value)->firstOrFail();
        $image = $character->ChampPicture;
        $imageUrlBanner = $character->image_url_banner;
        //$picture = "http://ddragon.leagueoflegends.com/cdn/13.18.1/img/champion/".$image;
        //dd($imageUrlBanner);
        return view('character.show', [
            'character' => $character,
            'imageUrlBanner' => $imageUrlBanner,
        ]);

    }
       
    

    public function indexChange()
    {
        $characters = Character::all();
    
        return view('character.CUD-Champions', [
        'characters' => $characters,
        
    ]);

       // return view('character.index');
    }


    public function show(int $id)
    {
        $character = Character::where('id', $id)->firstOrFail();
        $imageUrlBanner = $character->image_url_banner;
        
        return view('character.show', [
            'character' => $character,
            'imageUrlBanner' => $imageUrlBanner,
        ]);
    }

    public function add(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'lane' => 'required',
            'shop-cost' => 'required|numeric',
            'difficulty' => 'required',
            
        ]);
        
        Character::create($request->all());
        
        return back()->with("status", "Pomyślnie dodano championa!");
    }

    public function delete(Request $request)
    {

        $request->validate([
            'champion_id' => 'required',
        ]);
        
        $character = Character::where('id', $request->input('champion_id'))->firstOrFail();
        $character->delete();

        return back()->with("status", "Champion deleted successfully!");
	    
    }
    
    public function edit($id)
    {
        $character = Character::find($id);
        $characters = Character::pluck('name','id');
        return view('character.CUD-Champions', compact('character', 'characters'));
    }

    public function update(Request $request, $id)
    {
        
        $character = Character::find($id);
        $character->fill($request->all());
        /*$character->name = $request->input('name');
        $character->role = $request->input('role');
        $character->lane = $request->input('lane');
        $character->setAttribute('shop-cost', $request->input('shop-cost'));
        $character->difficulty = $request->input('difficulty');
        */
        $character->save();
        return redirect()->back()->with('status','Champion Updated Successfully');
	    
    }

    public function storeImage(Request $request, $id)
{
    $request->validate([
        'image' => 'required|image|mimes:png|max:2048',
    ]);
    
    $path = storage_path('Grafika');

    if (! is_dir($path)) {
        mkdir($path, 0777, true);
    }

    if ($file = $request->file('image')) {
        $filePath = $file->store(options: 'grafiki');
        Character::where('id', $id)->update(['ChampPicture' => 'storage/Grafika/'.$filePath]);
    }
    

    return redirect()
        ->back()
        ->with('success', 'Image successfully uploaded.');
}

public function filter(Request $request)
{
    $request->validate([
        'search' => 'string|nullable',
        'character_lane' => 'string|nullable',
        'character_role' => 'string|nullable',
        'character_cost' => 'string|nullable',
        'character_difficulty' => 'string|nullable'
    ]);
    $characters = Character::query();
    $filters = $request->all();
    //dd($filters,$request->input('character_lane'));

    if (array_key_exists('search', $filters) && !empty($filters['search'])) 
    {
        $characters->where('name', 'LIKE', '%'.$request->input('search').'%');
    } 

    if (array_key_exists('character_lane', $filters) && !empty($filters['character_lane'])) 
    {
        $characters->where('lane', $request->input('character_lane'));
    } 

    if (array_key_exists('character_role', $filters) && !empty($filters['character_role'])) 
    {
        $characters->where('role', $request->input('character_role'));
    } 

    if (array_key_exists('character_cost', $filters) && !empty($filters['character_cost'])) 
    {
        $characters->where('shop-cost', $request->input('character_cost'));
    } 

    if (array_key_exists('character_difficulty', $filters) && !empty($filters['character_difficulty'])) 
    {
        $characters->where('difficulty', $request->input('character_difficulty'));
    } 
   
    //dd($characters->get());
    return view('character.index', ['characters' => $characters->get()]);
}

    public function ChampionScore(Request $request)
    {
        
        $characterscore = new CharacterScore();
        $characterscore->ChampionId = $request->ChampionId;
        $characterscore->UserId = Auth::user()->id;
        $characterscore->Score = $request->Score;

        //$score = CharacterScore::get()->first();
        //dd($score->user);

        //CharacterScore::where('UserId', Auth::user()->id )
        if(CharacterScore::where('UserId', Auth::user()->id)->exists())
        {
            //dd($characterscore);
            //$characterscore->update();
            $characterscore = DB::table('characterscore')
              ->where('id', $characterscore->ChampionId)
              ->update(['Score' => $characterscore->Score]);
        }
        else{
            $characterscore->save();
        }
        
        
        //CharacterScore::query()->groupBy('ChampionId')->avg('Score')->get();

        return redirect()->back()->with('success','Your review has been submitted Successfully,');

    }

    public function ChampionLoldle(Request $request)
    {
        $Loldle = Loldle::select('created_at', 'updated_at');

        if($Loldle->where('updated_at', '>', Carbon::now()->subDays(1)->toDateTimeString()))
        {
            $character = Loldle::first();
            $partype = $character->partype;
            $difficulty = $character->difficulty;
            $stats = $character->stats;
            $tags = $character->tags;
            $name = $character->name;
            return view('character.Loldle', ['partype' => $partype, 'difficulty' => $difficulty, 'stats' => $stats, 'name' => $name], ['tags' => $tags]);
        }
        else 
        {
            $character = Character::select()->inRandomOrder()->limit(1)->first();
            $partype = $character->partype;
            $difficulty = $character->difficulty;
            $stats = $character->stats;
            $tags = $character->tags;
            $name = $character->name;

            $Loldle = DB::table('LoldleChamp')
              ->where('id', 1)
              ->update(['name' => $character->name], ['partype' => $character->partype], ['difficulty' => $character->difficulty], ['stats' => $stats = $character->stats], ['tags' => $tags = $character->tags]);
        
            return view('character.Loldle', ['partype' => $partype, 'difficulty' => $difficulty, 'stats' => $stats, 'name' => $name], ['tags' => $tags]);
        }

    }

    public function ChampionLoldleAnswer(Request $request)
    {
        $request->validate([
            'search' => 'string|nullable',
        ]);
        
        $characters = Character::query();
        $answer = $request->all();
        $Loldle = Loldle::first();
        $name = $Loldle->name;
        if (array_key_exists('search', $answer) && !empty($answer['search'])) 
        {
            if ($answer['search'] === $name)
            {
                return redirect()->back()->with('message','Odpowiedziałeś poprawnie!');
            } 
            else {
                return redirect()->back()->with('message', 'Niepoprawna odpowiedź, spróbuj jeszcze raz!');
            }
        } 

    }

    public function SugerowanyTeam($id)
    {
        $character = Character::where('id', $id)->firstOrFail();

       

        // dla toplanera
        if( $character->lane === 'Toplaner' )
        {
            $toplaner = $character;
            //dd($midlaner->tags);
            $jungler = Character::whereNotIn('tags', $toplaner->tags )->inRandomOrder()->limit(1)->first();
            $midlaner = Character::whereNotIn('tags', $toplaner->tags )->inRandomOrder()->limit(1)->first();
            //dd($toplaner);
            $adc = Character::where('tags', 'LIKE', '%Marksman%')->inRandomOrder()->limit(1)->first();
            
            $support = Character::where('tags', 'LIKE', '%Support%')->inRandomOrder()->limit(1)->first();
           
            return view('character.Sugerowanie', ['midlaner' => $midlaner->name,'jungler' => $jungler->name, 'toplaner' => $toplaner->name, 'adc' => $adc->name, 'support' => $support->name]);
        }

        // dla junglera
        if( $character->lane === 'Jungler' )
        {
            $jungler = $character;
            //dd($midlaner->tags);
            $midlaner = Character::whereNotIn('tags', $jungler->tags )->inRandomOrder()->limit(1)->first();
            $toplaner = Character::whereNotIn('tags', $jungler->tags )->inRandomOrder()->limit(1)->first();
            //dd($toplaner);
            $adc = Character::where('tags', 'LIKE', '%Marksman%')->inRandomOrder()->limit(1)->first();
            
            $support = Character::where('tags', 'LIKE', '%Support%')->inRandomOrder()->limit(1)->first();
           
            return view('character.Sugerowanie', ['midlaner' => $midlaner->name,'jungler' => $jungler->name, 'toplaner' => $toplaner->name, 'adc' => $adc->name, 'support' => $support->name]);
        }

        // dla midlanera
        if( $character->lane === 'Midlaner' )
        {
            $midlaner = $character;
            //dd($midlaner->tags);
            $jungler = Character::whereNotIn('tags', $midlaner->tags)->inRandomOrder()->limit(1)->first();
            $toplaner = Character::whereNotIn('tags', $midlaner->tags )->inRandomOrder()->limit(1)->first();
            //dd($toplaner);
            $adc = Character::where('tags', 'LIKE', '%Marksman%')->inRandomOrder()->limit(1)->first();
            
            $support = Character::where('tags', 'LIKE', '%Support%')->inRandomOrder()->limit(1)->first();
           
            return view('character.Sugerowanie', ['midlaner' => $midlaner->name,'jungler' => $jungler->name, 'toplaner' => $toplaner->name, 'adc' => $adc->name, 'support' => $support->name]);
        }

        // dla ADC
        if( $character->lane === 'ADC' )
        {
            $adc = $character;
            //dd($midlaner->tags);
            $jungler = Character::whereNotIn('tags', 'tags', 'LIKE', '%Marksman%' )->inRandomOrder()->limit(1)->first();
            $toplaner = Character::whereNotIn('tags', 'tags', 'LIKE', '%Marksman%' )->inRandomOrder()->limit(1)->first();
            //dd($toplaner);
            $midlaner = Character::whereNotIn('tags', 'tags', 'LIKE', '%Marksman%' )->inRandomOrder()->limit(1)->first();
            
            $support = Character::where('tags', 'LIKE', '%Support%')->inRandomOrder()->limit(1)->first();
           
            return view('character.Sugerowanie', ['midlaner' => $midlaner->name,'jungler' => $jungler->name, 'toplaner' => $toplaner->name, 'adc' => $adc->name, 'support' => $support->name]);
        }

        // dla supporta
        if( $character->lane === 'Support' )
        {
            $support = $character;
            //dd($midlaner->tags);
            $jungler = Character::whereNotIn('tags', 'tags', 'LIKE', '%Support%' )->inRandomOrder()->limit(1)->first();
            $toplaner = Character::whereNotIn('tags', 'tags', 'LIKE', '%Support%' )->inRandomOrder()->limit(1)->first();
            //dd($toplaner);
            $midlaner = Character::whereNotIn('tags', 'tags', 'LIKE', '%Support%' )->inRandomOrder()->limit(1)->first();
            
            $adc = Character::where('tags', 'LIKE', '%Marksman%')->inRandomOrder()->limit(1)->first();
           
            return view('character.Sugerowanie', ['midlaner' => $midlaner->name,'jungler' => $jungler->name, 'toplaner' => $toplaner->name, 'adc' => $adc->name, 'support' => $support->name]);
        }

    }

}
