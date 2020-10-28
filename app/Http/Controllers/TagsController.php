<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TagsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_id = Auth::user()->currentTeamId();
        $tags = Tag::where('team_id', $team_id)->get();
        return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->isAdmin()||Auth::user()->isOwner()||Auth::user()->isEditor()) {
            $validatedData = $request->validate(['name' => 'required|max:20']);
            $validatedData['user_id'] = Auth::user()->id;
            $validatedData['team_id'] = Auth::user()->currentTeamId();
            Tag::create($validatedData);
            $request->session()->flash('comment_message', 'tag created');
            return redirect()->route('tags.index');
        } else {
            $request->session()->flash('danger_message', 'Nu poti adauga daca nu esti administrator sau owner sau editor ');
            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team_id= Auth::user()->currentTeamId();
        if(Auth::user()->isAdmin()||Auth::user()->isOwner()){
            $tags = Tag::where('team_id', $team_id)
                ->get();
            $t = Tag::where('id', $id)
                ->where('team_id', $team_id)
                ->first();
            if($t){
                return view('tags.edit' , compact('tags' , 't'));
            }else{
                Session::flash('danger_message','nu ai selectat bine administratore');
                return redirect()->route('tags.index');
            }


        }elseif(Auth::user()->isEditor()){
            $tags = Tag::where('team_id', $team_id)->get();
            $t = Tag::where('id', $id)
                ->where('team_id', $team_id)
                ->where('user_id', Auth::user()->id)
                ->first();

            if($t){
                return view('tags.edit' , compact('tags' , 't'));
            }else{
                Session::flash('danger_message','nu ai selectat bine editore ');
                return redirect()->route('tags.index');
            }


        }else{
            Session::flash('danger_message','nu poti modifica daca nu esti administrator owner sau editor');

            return redirect()->route('categories.index');
        }


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
        $validatedData = $request->validate(['name'=>'required|max:20']);
        $team_id = Auth::user()->currentTeamId();

        if(Auth::user()->isAdmin()|| Auth::user()->isOwner()){
            $tag = Tag::where('id', $id)
                ->where('team_id', $team_id)
                ->first();
            if($tag){
                $tag->update($validatedData);
                $request->session()->flash('comment_message', "tag updated");
                return redirect()->route('tags.index');
            }else{
                $request->session()->flash('danger_message', "mai cauta administratore");
                return redirect()->route('tags.index');
            }

        }elseif(Auth::user()->isEditor()){
            $tag = Tag::where('id', $id)
                ->where('team_id', $team_id)
                ->where('user_id' , Auth::user()->id)
                ->first();
            if($tag){
                $tag->update($validatedData);
                $request->session()->flash('comment_message', "tag updated");
                return redirect()->route('tags.index');
            }else{
                $request->session()->flash('danger_message', "mai cauta editore ");
                return redirect()->route('tags.index');
            }
        }else{
            $request->session()->flash('danger_message', "trebuie sa fi administrator, owner sau editor se modifici tagul");
            return redirect()->route('tags.index');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team_id = Auth::user()->currentTeamId();

        if(Auth::user()->isAdmin()|| Auth::user()->isOwner()){
            $tag = Tag::where('id', $id)
                ->where('team_id', $team_id)
                ->first();
            if($tag){
                $tag ->delete();
                Session::flash('comment_message', "tag deleted");
                return redirect()->route('tags.index');
            }else{
                Session::flash('danger_message', "mai cauta administratore");
                return redirect()->route('tags.index');
            }

        }elseif(Auth::user()->isEditor()){
            $tag = Tag::where('id', $id)
                ->where('team_id', $team_id)
                ->where('user_id' , Auth::user()->id)
                ->first();
            if($tag){
                $tag->delete();
                Session::flash('comment_message', "tag deleted");
                return redirect()->route('tags.index');
            }else{
                Session::flash('danger_message', "mai cauta editore ");
                return redirect()->route('tags.index');
            }
        }else{
            Session::flash('danger_message', "trebuie sa fi administrator, owner sau editor sa etergi assetul");
            return redirect()->route('tags.index');
        }


    }

}
