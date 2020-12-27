<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use Illuminate\Support\Facades\Session;

class DocumentsController extends Controller
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
        //
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

    }

    /**
     * Store a new document af an existing atribute.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeDocumentOfAnAtribute(Request $request, int $id)
    {
        $team_id = Auth::user()->currentTeamId();
        if (Auth::user()->isAdmin() || Auth::user()->isOwner() || Auth::user()->isEditor()) {
            $request->validate([

                'document_name' => 'max:50|regex:/^[a-zA-Z0-9\s]+$/|nullable',
                'document' => 'max:10000|file|mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf,tif,tiff'
            ]);
            if($request->document_name){
                $data['name']= $request->document_name;
            } else $data['name']= "no name";

        $data['atribute_id'] = $id;
        $data['user_id'] = Auth::user()->id;
        $data['team_id']= $team_id;
        if($file= $request->file('document')){

            $file_name =time() . $file->getClientOriginalName();
            $file->move('documents', $file_name);
            $data['link'] = $file_name;
            $document = Document::create($data);
        } else {$request->session()->flash('danger_message', 'pleasse attach a valid document file');
            return redirect()->back();
        }



            $request->session()->flash('comment_message', 'New document added ');
            return redirect()->back();


        } else {
            $request->session()->flash('danger_message', 'nu esti membru al acestui grup deci nu poti salva documente ');
            return redirect()->back();
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
        $team_id = Auth::user()->currentTeamId();
        $document = Document::where('id', $id)
                                ->where('team_id', $team_id)
                                ->first();
        if($document) {
            return view('documents.show', compact('document'));

        }else {
            Session::flash('danger_message', 'document not exists');
            return redirect()->back();

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([

            'document_name' => 'max:50|regex:/^[a-zA-Z0-9\s]+$/|nullable',
            'document' => 'max:10000|file|mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf,tif,tiff'
        ]);



        if (Auth::user()->isAdmin() || Auth::user()->isOwner() ) {

            $document = Document::where('team_id', $team_id)
                ->where('id', $id)
                ->first();

            if($document) {
                $input['name'] = $request->document_name;
                $input['user_id'] = Auth::user()->id;
                if($file= $request->file('document')) {

                    $file_name = time() . $file->getClientOriginalName();
                    $file->move('documents', $file_name);
                    unlink(public_path() . '/documents/' . $document->link);
                    $input['link'] = $file_name;
                }

                $document->update($input);

                $request->session()->flash('comment_message', 'document updated succsesfuly administratore ');
                    return redirect()->back();


            }else {
                    $request->session()->flash('danger_message', 'you cannot update document administratore ');
                    return redirect()->back();

                }


            } elseif (Auth::user()->isEditor()){

            $document = Document::where('team_id', $team_id)
                ->where('id', $id)
                ->where ('user_id', Auth::user()->id)
                ->first();


                if($document) {
                    $input['name'] = $request->document_name;
                    $input['user_id'] = Auth::user()->id;
                    if($file= $request->file('document')) {

                        $file_name = time() . $file->getClientOriginalName();
                        $file->move('documents', $file_name);
                        unlink(public_path() . '/documents/' . $document->link);
                        $input['link'] = $file_name;
                    }

                    $document->update($input);
                    $request->session()->flash('comment_message', 'document updated succsesfuly');
                    return redirect()->back();


            }else {
                $request->session()->flash('danger_message', 'you cannot update document editore  ');
                return redirect()->back();

            }



        } else {
            $request->session()->flash('danger_message', 'you have to be member of team to update a document');
            return redirect()->back();

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
         $document = Document::where('id', $id)
                                ->where('team_id', $team_id)
                                ->first();
         if($document){
             unlink(public_path() . '/documents/' . $document->link);
             $document->delete();
             Session::flash('comment_message', 'document deleted succsesfully');
             return redirect()->back();
         } else {
             Session::flash('danger_message', 'you cannot delete document');
             return redirect()->back();

         }



        }elseif(Auth::user()->isEditor()){

            $document = Document::where('id', $id)
                ->where('team_id', $team_id)
                ->where('user_id', Auth::user()->id)
                ->first();
            if($document){
                unlink(public_path() . '/documents/' . $document->link);
                $document->delete();
                Session::flash('comment_message', 'document deleted succsesfully');
                return redirect()->back();
            } else {
                Session::flash('danger_message', 'you cannot delete document');
                return redirect()->back();

            }


        }else{
            Session::flash('danger_message', 'have to be member of team to delete a document');
            return redirect()->back();
        }
    }
}
