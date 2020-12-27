<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Atribute;
use App\Models\Document;
use App\Models\Tag;




class AssetsController extends Controller
{
//middlware
    public function __construct()
    {
        $this->middleware('auth');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){


//        if(Auth::user()->isEditor())return ('is editor'); else return ('nu este editor');

//   dd(Auth::user()->currentTeamName());
//        dd(Auth::user()->currentTeamId());

//        dd(Auth::user()->userRoleInCurrentTeam());
//       dd(Auth::user()->usersOfCurrentTeam());
//

//



//        $usersOfCurrentTeam = Auth::user()->usersOfCurrentTeam();


        $team_id = Auth::user()->currentTeamId();

        $assets = Asset::where('team_id', $team_id)->get();
//

        return view('assets.index', compact ('assets'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team_id = Auth::user()->currentTeamId();
        $categories = Category::where('team_id', $team_id)->pluck('name', 'id')->unique()->all();

//        returneaza un array toata coloana name valoarea = ia namne din category iar daca vrem sa ii punem si keie  - key este al doilea parametru al Pluck()

        return view('assets.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isOwner() || Auth::user()->isEditor()) {
            $validatedData = $request->validate([
                'name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
                'category_id' => 'nullable'

            ]);
            $user = Auth::user()->id;


            $team_id = Auth::user()->currentTeamId();
            $validatedData['user_id'] = $user;
            $validatedData['team_id'] = $team_id;


            $asset= Asset::create($validatedData);


            $request->session()->flash('comment_message', 'asset uploaded succsesfuly');

            return redirect()->route('assets.index' );
        } else {
            $request->session()->flash('danger_message', 'Nu poti adauga daca nu esti administrator sau owner sau editor ');
            return redirect()->route('assets.index');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $team_id = Auth::user()->currentTeamId();

        $asset = Asset::where('slug', $slug)
                        ->where('team_id',$team_id)
                        ->first();
        $atributes = Atribute::where('asset_id', $asset->id)
                                ->where('team_id',$team_id)
                                ->get();
        $users = User::all();
/*
 * documentele unui activ
 */
//        obtinere id la colectia de atribute ale activului ($slug)
        foreach($asset->atributes as $atribute){
            $id_atributes_asset []= $atribute->id;
        }

//        $documents = Document::whereIn('atribute_id', $id_atributes_asset)
//                                ->where('team_id', $team_id)
//                                ->get();
/*
 * tagurile unui activ adica a tuturor atributelor unui activ
 */
        $tags = Tag::where('team_id', $team_id)->get();





        return view('assets.show', compact('asset','atributes','tags', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isOwner()) {
            $team_id = Auth::user()->currentTeamId();
            $asset = Asset::where('slug', $slug)
                           ->where('team_id' , $team_id )->first();

                        if($asset) {

                $categories = Category::where('team_id', $team_id)->pluck('name', 'id')->unique()->all();
                return view('assets.edit', compact('asset', 'categories'));
                         } else {
                                 Session::flash('danger_message','nu ai selectat bine administratore');

                                 return redirect()->route('assets.index');
                                }
        } elseif(Auth::user()->isEditor()){
            $team_id = Auth::user()->currentTeamId();
            $asset = Asset::where('slug', $slug)
                ->where('user_id' , Auth::user()->id )
                        ->where('team_id' , $team_id )->first();
                         if($asset) {

                             $categories = Category::where('team_id', $team_id)->pluck('name', 'id')->unique()->all();
                             return view('assets.edit', compact('asset', 'categories'));
                         } else {
                             Session::flash('danger_message','nu ai selectat bine editore');

                             return redirect()->route('assets.index');
                         }
        }

            else {
               Session::flash('danger_message','nu poti modifica daca nu esti administrator owner sau editor');

                return redirect()->route('assets.index');
            };
        }







    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $team_id = Auth::user()->currentTeamId();
    if (Auth::user()->isAdmin() || Auth::user()->isOwner()) {

        $input = $request->validate([
            'name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
           'category_id' => 'nullable'
        ]);


        $asset = Asset::where('id', $id)
                ->where ('team_id' , $team_id)
                ->first();
            if($asset){
                $asset->update($input);
                $request->session()->flash('comment_message', 'Asset Updated succesfully');
                return redirect()->route('assets.index');
            }else{
                $request->session()->flash('danger_message' , 'nu ai gasit assetul administratore');
                return redirect()->route('assets.index');
            }


    } elseif(Auth::user()->isEditor()){
        $input = $request->validate([
            'name'=>'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
            'category_id'=>'nullable'
        ]);
        $asset = Asset::where('id', $id)
                        ->where('user_id', Auth::user()->id)
                        ->where('team_id', $team_id)
                        ->first();
            if($asset){
                $asset->update($input);
                $request->session()->flash('comment_message', 'asset updated succesfuly');
                return redirect()->route('assets.index');
            }else{
                $request->session()->flash('danger_message', 'nu ai selectat bine assetul editore');
                return redirect()->route('assets.index');
            };


    }else{
        $request->session()->flash('danger_message','trebuie sa fi administrator, owner sau editor se modifici assetul');
        return redirect()->route('assets.index');

    };

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->isAdmin() || Auth::user()->isOwner()){
            $team_id = Auth::user()->currentTeamId();
            $asset = Asset::where('id', $id)
                ->where('team_id', $team_id)->first();
                if($asset){
                    $asset->delete();
                    Session::flash('comment_message', 'Asset deleted succsesfully');
                    return redirect()->route('assets.index');
                }else{
                    Session::flash('danger_message', 'Nu ai gasit Assetul administratore');
                    return redirect()->route('assets.index');
                }

        }elseif (Auth::user()->isEditor()){
            $asset = Asset::where('id', $id)
                            ->where('user_id', Auth::user()->id)->first();
                if($asset){
                    $asset ->delete();
                    Session::flash('comment_message', 'Asset deleted succsesfully' );
                    return redirect()->route('assets.index');
                }else{
                    Session::flash('danger_message', 'nu ai gasit assetul editore');
                    return redirect()->route('assets.index');
                }

        } else{
            Session::flash('danger_message' , 'trebuie sa fi administrator, owner  sau editor sa stergi acest mesaj' );
            return redirect()->route('assets.index');
        }
    }

    /**
     * show assets by category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexbycategory($id)
    {

        $team_id = Auth::user()->currentTeamId();
        $category = Category::where('id', $id)
                                ->where('team_id', $team_id)
                                ->first();


        $assets = Asset::where('category_id', $id)
                        ->where('team_id', $team_id)
                        ->get();
       return view('assets.indexbycategory', compact('assets','category'));

    }
}
