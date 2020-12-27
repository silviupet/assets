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
use Illuminate\Support\Facades\Route;


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
        $atributes = Atribute::where('team_id', $team_id)->paginate(10);
//        dd($atributes);

////luam doar atributele care nu al o legatura cu un asset si cele ale caror asset nu a fost sters
//        $a = [];
//       foreach($atributes as $atribute){
//
//           if(!$atributes->has('asset'))
//            $a []= $atribute;
//           else
//               if ($atribute->asset->deleted_at === null)
//
//
//                   $a []= $atribute;
//           }
//
//
//
//
//
//

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
     * Show the form for creating a new resource.
     * Create an atribute for a specific asset
     * @return \Illuminate\Http\Response
     */
    public function createAtributeOfAnAsset($id)
    {


//        dd(Route::currentRouteName());

        $team_id = Auth::user()->currentTeamId();

        $tags = Tag::where('team_id', $team_id)->pluck('name', 'id')->unique()->all();
        return view('atributes.create',compact( 'tags' , 'id' ) );
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
            'document_name'=>'max:50|regex:/^[a-zA-Z0-9\s]+$/|nullable',
           'document'=>'max:10000|file|mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf,tif,tiff'
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


        $asset = Asset::where('id', $request['asset_id'])->first();








      if($asset){
          $atribute = $asset->atributes()->create($atribute_data);


          $tag_id=$request->tag_id;
//     attach atribute-tag only if in form there are tag selected. With array filter will eliminate elements that casts to false(null, o, etc)
        $new_tag_id = array_filter($tag_id);

          if(!empty($new_tag_id)) {

             $atribute->tags()->attach($tag_id);
          }
// check if  are document uploaded and if so are moved and registered in DB
          if($file = $request->file('document')){



              $file_name =time() . $file->getClientOriginalName();
              $file->move('documents', $file_name);
              $atribute->documents()->create(['name'=>$request->document_name ?? "document_name" , 'link'=>$file_name, 'user_id'=>Auth::user()->id, 'team_id' => Auth::user()->currentTeamId()]);

          }

          $request->session()->flash('comment_message', 'atribute upload succesfuly');
          return redirect()->route('atributes.index');

      }else{
          $request->session()->flash('danger_message', 'Nu ai selectat corect ');
          return redirect()->route('assets.index');
      }

        }else{
            $request->session()->flash('danger_message', 'Nu poti adauga daca nu esti administrator sau owner sau editor ');
            return redirect()->route('asset.index');
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
        if (Auth::user()->isAdmin() || Auth::user()->isOwner()){
            $atribute = Atribute::where('team_id', $team_id)
                ->where('id', $id)
                ->first();
//        $assets = Asset::where('team_id', $team_id)
//                        ->pluck('name', 'id')->unique()->all();

        $tags = Tag::where('team_id', $team_id)->pluck('name', 'id')->unique()->all();
            if($atribute){
                return view('atributes.edit', compact('atribute', 'tags'));
            }else{
                Session::flash('danger_message','nu ai selectat bine administratore');

                return redirect()->route('assets.index');
            }

        }elseif(Auth::user()->isEditor()){
            $atribute = Atribute::where('team_id', $team_id)
                ->where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();
//        $assets = Asset::where('team_id', $team_id)
//                        ->pluck('name', 'id')->unique()->all();

//        $tags = Tag::where('team_id', $team_id)->pluck('name', 'id')->unique()->all();
            if($atribute){
                return view('atributes.edit', compact('atribute'));
            }else{
                Session::flash('danger_message','nu ai selectat bine editore');

                return redirect()->route('assets.index');
            }



        }else{
            Session::flash('danger_message','nu poti modifica daca nu esti administrator owner sau editor');

            return redirect()->route('assets.index');
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

        $team_id = Auth::user()->currentTeamId();
        $input = $request->validate([
            'name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'max:100|regex:/^[a-zA-Z0-9\s]+$/|nullable',
            'from_date' => 'date',
            'expiry_date' => 'date',
            'price' => 'numeric|nullable',
            'vendor' => 'max:50|regex:/^[a-zA-Z0-9\s]+$/|nullable',
            'other_conditions' => 'max:100|regex:/^[a-zA-Z0-9\s]+$/|nullable',
//            'document_name'=>'max:50|regex:/^[a-zA-Z0-9\s]+$/|nullable',
//            'document'=>'max:10000|file|mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf,tif,tiff'
        ]);


//        $input_documents['name']= $request->document_name;
//        if($file = $request->file('document')){
//          $file_name = time(). $file->getClientOriginalName();
//            $file ->move('documents' , $file_name);
//
//
//        $input_documents['link'] = $file_name;
//
//
//        }

        if (Auth::user()->isAdmin() || Auth::user()->isOwner())
        {
            $atribute = Atribute::where('id', $id)
                                ->where('team_id', $team_id)
                                ->first();
            if($atribute){


                $atribute->update($input);
//               $atribute->documents()->update($input_documents);



                $request->session()->flash('comment_message', ' Atribute updated susscefully administratore');
                return redirect()->route('atributes.index');

            }else{
                $request->session()->flash('danger_message' , 'Do yo try to hack this site? Police is on way ');
                return redirect()->route('assets.index');
            }


        }elseif(Auth::user()->isEditor()){
            $atribute = Atribute::where('id', $id)
                ->where('team_id', $team_id)
                ->where('user_id', Auth::user()->id)
                ->first();
            if($atribute) {
                $input['user_id'] = Auth::user()->id;
                $atribute->update($input);
                $request->session()->flash('comment_message', ' Atribute updated susscefully editore');
                return redirect()->route('assets.index');
            }else{
                $request->session()->flash('danger_message' , 'Do yo try to hack this site? Police is on way ');
                return redirect()->route('assets.index');
            }
        }else{
            $request->session()->flash('danger_message','nu poti modifica daca nu esti administrator owner sau editor');

            return redirect()->route('assets.index');
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
        if(Auth::user()->isAdmin() || Auth::user()->isOwner()){

            $atribute = Atribute::where('id', $id)
                ->where('team_id', $team_id)->first();
            if($atribute){

               if($atribute->documents()->exists()){


                    foreach ($atribute->documents as $document) {

                        $document->delete();


                       unlink(public_path() . '/documents/' . $document->link);

                    }
                    }

//                stergere taguri aferente atributului

                if($atribute->tags()->exists()) {

                    foreach ($atribute->tags as $tag) {
                        $atribute->tags()->detach($tag->id);
                    }
                }

                $atribute->delete();

                Session::flash('comment_message', 'Atribute deleted succsesfully');
                return redirect()->route('atributes.index');
            }else{
                Session::flash('danger_message', 'Nu ai gasit Assetul administratore');
                return redirect()->route('atributes.index');
            }

        }elseif (Auth::user()->isEditor()){
            $atribute = Atribute::where('id', $id)
                ->where('user_id', Auth::user()->id)->first();
            if($atribute){
                //                stergere documente aferente atributului
                foreach($atribute->documents as $document){
                    if($atribute->documents->has('documents'))
                        unlink(public_path() . '/documents/'. $document->link);
                }
//                stergere taguri aferente atributului
                foreach($atribute->tags as $tag){
                    $atribute->tags()->detach($tag->id);
                }

                $atribute ->delete();
                Session::flash('comment_message', 'Atribute deleted succsesfully' );
                return redirect()->route('atributes.index');
            }else{
                Session::flash('danger_message', 'nu ai gasit assetul editore');
                return redirect()->route('atributess.index');
            }

        } else{
            Session::flash('danger_message' , 'trebuie sa fi administrator, owner  sau editor sa stergi acest mesaj' );
            return redirect()->route('atributes.index');
        }
    }

}
