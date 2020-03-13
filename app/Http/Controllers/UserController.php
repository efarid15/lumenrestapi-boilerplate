<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function index(){
        $data = User::all();
        return response()->json(['status' => 'success', 'data' => $data]);

    }

    public function show($id){
        $data = User::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);

    }

    public function store (Request $request){
        $data = new User;
        $data->id = Uuid::uuid4()->getHex();
        $data->username = $request->input('username');
        $data->password = app('hash')->make($request->password);
        $data->email = $request->input('email');
        //dd($data);

        if ($data->save()){
            return response()->json(['status' => 'success']);
        }
        return \response()->json(['status' => 'gagal', 'pesan' => 'Gagal simpan data']);


    }
}
