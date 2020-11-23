<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtributeRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Atribute;
use App\Models\Asset;
use App\Models\Tag;

class AtributesController extends Controller
{

    /**
     * middlware
     */
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
        $atributes = Atribute::where('team_id', $team_id)->get();


        return view('atributes.index', compact('atributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team_id = Auth::user()->currentTeamId();
        $assets = Asset::where('team_id', $team_id)->pluck('name', 'id')->unique()->all();
        $tags = Tag::where('team_id', $team_id)->pluck('name', 'id')->unique()->all();
        return view('atributes.create',compact('assets' , 'tags') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->isAdmin()|| Auth::user()->isOwner() || Auth::user()->isEditor()){
        $request->validate([
            'name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'max:100|regex:/^[a-zA-Z0-9\s]+$/|nullable',
            'from_date' => 'date',
            'expiry_date' => 'date',
            'price' => 'numeric|nullable',
            'vendor' => 'max:50|regex:/^[a-zA-Z0-9\s]+$/|nullable',
            'other_conditions' => 'max:100|regex:/^[a-zA-Z0-9\s]+$/|nullable',
            'document_name'=>'max:50|regex:/^[a-zA-Z0-9\s]+$/',
           'document'=>'max:1000|file|mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf,tif,tiff'
        ]);





        $atribute_data['name']= $request->name;
        $atribute_data['description'] = $request->description;
        $atribute_data['from_date']=$request->from_date;
        $atribute_data['expiry_date'] = $request->expiry_date;
        $atribute_data['price']=$request->price;
        $atribute_data['currency'] = $request->currency;
        $atribute_data['vendor'] = $request->vendor;
        $atribute_data['other_conditions'] = $request->other_conditions;

        $atribute_data['user_id'] = Auth::user()->id;
        $atribute_data['team_id'] = Auth::user()->currentTeamId();

       $asset = Asset::findorFail($request->asset_id);
       $atribute = $asset->atributes()->create($atribute_data);

           $atribute->tags()->attach([2,3]);
           $atribute->documents()->create(['name'=>$request->document_name , 'link'=>'path' , 'user_id'=>Auth::user()->id, 'team_id' => Auth::user()->currentTeamId()]);
           $request->session()->flash('comment_message', 'atribute upload succesfuly');
           return redirect()->route('atributes.index');
        }else{
            $request->session()->flash('danger_message', 'Nu poti adauga daca nu esti administrator sau owner sau editor ');
            return redirect()->route('atributes.index');
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
        $team_id = Auth::user()->currentTeamId();
        $atribute = Atribute::where('team_id', $team_id)
                                ->where('id', $id)
                                ->first();
        $assets = Asset::where('team_id', $team_id)
                        ->pluck('name', 'id')->unique()->all();

        $tags = Tag::where('team_id', $team_id)->pluck('name', 'id')->unique()->all();
        return view('atributes.edit', compact('assets','atribute','tags'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
