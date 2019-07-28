<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Data;
use Auth;
use Illuminate\Support\Facades\Crypt;
class DataController extends Controller
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
        $files1 = scandir('tamu/');
        $arraydata = [];
        $name = [];
        foreach ($files1 as $key => $value) {
            if ($key != 0 && $key != 1) {
                $array = explode(",",file_get_contents('tamu/'.$value));
                $hasil = [];
                foreach ($array as $keys => $values) {
                    $hasil[] = decrypt($values);
                }
                $arraydata[] = $hasil;
                $name[] = $value;
            }
        }
        $data = $arraydata;
        // $data=Data::orderBy('id','desc')->get();
        return view('data.list',compact('data','name')); 
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
    //

        return view('data.add');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    //
        $request->validate([
            "nama" => 'required',
            "email" => 'required',
            "date" => 'required',
            'tlp' => 'required',
            'gender' => 'required',
            'foto'=>'required'
        ]);

        $file = $request->file('foto');
        $foto = null;
        if ($file) {
            $file->move(base_path('public/foto'),date('YmdHis').'_'.$file->getClientOriginalName());
            $foto = date('YmdHis').'_'.$file->getClientOriginalName();
        }
        // $data = new Data();

        // $data->nama = $request->nama; 
        // $data->email = $request->email;
        // $data->date = $request->date;
        // $data->telepon = $request->tlp;
        // $data->gender = $request->gender;
        // $data->foto = $foto;

        // $data->save();

        // dd(json_encode($request->nama));
        $text = encrypt($request->nama).','.encrypt($request->email).','.encrypt($request->date).','.encrypt($request->tlp).','.encrypt($request->gender).','.encrypt($foto);
        $filename = $request->nama.date('YmdHis').".txt";
        $fh = fopen('tamu/'.$filename, "a");
        fwrite($fh, $text);
        fclose($fh);

    // dd($data);
        // $data=Data::orderBy('id','desc')->get();
        return redirect(route('data.index'))->with('flash-notif',[
            "notif" => "success",
            "message" => "Berhasil Disimpan"
        ]);



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
        $data = explode(",",file_get_contents('tamu/'.$id));
        return view('data.edit',compact('data','id'));
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

        $request->validate([
            "nama" => 'required',
            "email" => 'required',
            "date" => 'required',
            'tlp' => 'required',
            'gender' => 'required',
        ]);
        // $data = Data::find($id);

        $fi = explode(',',file_get_contents('tamu/'.$id));

        $file = $request->file('foto');
        $foto = null;
        if ($file) {
            unlink('foto/'.decrypt($fi[5]));
            $file->move(base_path('public/foto'),date('YmdHis').'_'.$file->getClientOriginalName());
            $foto = date('YmdHis').'_'.$file->getClientOriginalName();
        }else{
            // dd(file_get_contents('tamu/'.$id));
            $foto = decrypt($fi[5]);
        }
        $myfile = fopen('tamu/'.$id, "w") or die("Unable to open file!");
        $text = encrypt($request->nama).','.encrypt($request->email).','.encrypt($request->date).','.encrypt($request->tlp).','.encrypt($request->gender).','.encrypt($foto);
        fwrite($myfile, $text);
        fclose($myfile);

        // $data->nama = $request->nama; 
        // $data->email = $request->email;
        // $data->date = $request->date;
        // $data->telepon = $request->tlp;
        // $data->gender = $request->gender;
        // $data->foto = $foto;

        // $data->save();
        return redirect(route('data.index'))->with('flash-notif',[
            "notif" => "success",
            "message" => "Berhasil Diedit"
        ]);
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
        // Data::find($id)->delete();
        $fi = explode(',',file_get_contents('tamu/'.$id));
        unlink('foto/'.decrypt($fi[5]));
        unlink('tamu/'.$id) or die("Couldn't delete file");
        return redirect()->back();
    }
}
