<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{

    public function __construct()
    {
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
        $categories= Category::where('team_id' , $team_id)->get();
        return view('categories.index',compact ('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $validatedData = $request->validate(['name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/']);
            $validatedData['user_id'] = Auth::user()->id;
            $validatedData['team_id'] = Auth::user()->currentTeamId();
            Category::create($validatedData);
            $request->session()->flash('comment_message', 'category added ');

            return redirect()->route('categories.index');
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
            $categories = Category::where('team_id', $team_id)
                                ->get();
          $cat = Category::where('id', $id)
                            ->where('team_id', $team_id)
                            ->first();
          if($cat){
              return view('categories.edit' , compact('categories' , 'cat'));
          }else{
              Session::flash('danger_message','nu ai selectat bine administratore');
              return redirect()->route('categories.index');
          }


      }elseif(Auth::user()->isEditor()){
          $categories = Category::where('team_id', $team_id)->get();
          $cat = Category::where('id', $id)
                            ->where('team_id', $team_id)
                            ->where('user_id', Auth::user()->id)
                            ->first();

          if($cat){
              return view('categories.edit' , compact('categories' , 'cat'));
          }else{
              Session::flash('danger_message','nu ai selectat bine editore ');
              return redirect()->route('categories.index');
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
        $input = $request->validate(['name'=>'required|max:50|regex:/^[a-zA-Z0-9\s]+$/']);
        $team_id = Auth::user()->currentTeamId();

        if(Auth::user()->isAdmin()|| Auth::user()->isOwner()){
            $category = Category::where('id', $id)
                                ->where('team_id', $team_id)
                                ->first();
            if($category){
                $category->update($input);
                $request->session()->flash('comment_message', "category updated");
                return redirect()->route('categories.index');
            }else{
                $request->session()->flash('danger_message', "mai cauta administratore");
                return redirect()->route('categories.index');
            }

        }elseif(Auth::user()->isEditor()){
            $category = Category::where('id', $id)
                                ->where('team_id', $team_id)
                                ->where('user_id' , Auth::user()->id)
                                ->first();
            if($category){
                $category->update($input);
                $request->session()->flash('comment_message', "category updated");
                return redirect()->route('categories.index');
            }else{
                $request->session()->flash('danger_message', "mai cauta editore ");
                return redirect()->route('categories.index');
            }
        }else{
            $request->session()->flash('danger_message', "trebuie sa fi administrator, owner sau editor se modifici assetul");
            return redirect()->route('categories.index');
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
            $category = Category::where('id', $id)
                ->where('team_id', $team_id)
                ->first();
            if($category){
                $category ->delete();
                Session::flash('comment_message', "category deleted");
                return redirect()->route('categories.index');
            }else{
                Session::flash('danger_message', "mai cauta administratore");
                return redirect()->route('categories.index');
            }

        }elseif(Auth::user()->isEditor()){
            $category = Category::where('id', $id)
                ->where('team_id', $team_id)
                ->where('user_id' , Auth::user()->id)
                ->first();
            if($category){
                $category->delete();
                Session::flash('comment_message', "category deleted");
                return redirect()->route('categories.index');
            }else{
                Session::flash('danger_message', "mai cauta editore ");
                return redirect()->route('categories.index');
            }
        }else{
            Session::flash('danger_message', "trebuie sa fi administrator, owner sau editor sa etergi assetul");
            return redirect()->route('categories.index');
        }


    }
}
