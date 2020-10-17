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
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'category_id'=>'required'

        ]);
        $user = Auth::user()->id;


        $team_id=Auth::user()->currentTeamId();
        $validatedData['user_id'] = $user;
        $validatedData['team_id']=$team_id;





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
        if (Auth::user()->isAdmin() || Auth::user()->isOwner()) {
            $team_id = Auth::user()->currentTeamId();
            $asset = Asset::where('id', $id)
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
            $asset = Asset::where('id', $id)
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
    if (Auth::user()->isAdmin() || Auth::user()->isOwner()) {

        $input = $request->validate([
            'name' => 'required|max:50',
            'category_id' => 'required'
        ]);
        $team_id = Auth::user()->currentTeamId();
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
            'name'=>'required|max:50',
            'category_id'=>'required'
        ]);
        $asset = Asset::where('id', $id)
                        ->where('user_id', Auth::user()->id)
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
}
