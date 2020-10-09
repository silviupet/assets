<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;





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

// $b = $a->currentTeamName();
//// dd($b);

        $a = Auth::user()->userRoleInCurrentTeam();
//        dd($a);
    //     $currentTeam =Auth::user()->currentTeam->name;
//        dd($currentTeam);
//
//     $roleInTeam = Auth::user()->teamRole($currentTeam)->name;
//    dd($roleInTeam);



        $assets = Asset::all();

        return view('assets.index', compact ('assets'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->all();
//        returneaza un array valoarea = ia namne din category iar daca vrem sa ii punem si keie  - key este al doilea parametru al Pluck()

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
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'category_id'=>'required'
        ]);
        $user = Auth::user()->id;
        $team_id = Auth::user()->currentTeamId();


        $validatedData['user_id'] = $user;
        $validatedData['team_id'] = $team_id;




       Asset::create($validatedData);
        $request->session()->flash('comment_message','asset uploaded succsesfuly');

        return redirect()->route('assets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $categories = Category::pluck('name', 'id')-> all();
        return view('assets.edit', compact('asset', 'categories'));
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
        $input = $request->validate([
            'name' => 'required|max:50',
            'category_id'=>'required'
        ]);
        Auth::user()->assets()->whereId($id)->first()->update($input);
        $request->session()->flash('comment_message', 'Asset update succsesfully');
        return redirect()->route('assets.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);


        $asset->delete();
       Session::flash('comment_message', 'Asset deleted succsesfully');
        return redirect()->route('assets.index');
    }
}
