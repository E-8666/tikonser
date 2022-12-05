<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tiket::all();
        return response()->json([
            "message" => "Data berhasil ditampilkan",
            "data" => $data
        ], 200);
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
        $data = Tiket::create($request->all());

        if ($data) {
            return response([
                'status' => 201,
                'message' => "Data berhasil diunggah",
                'data' => $data
            ]);
        }else {
            return response([
                'status' => 400,
                'message' => "Data gagal diunggah",
                'data' => null
            ]);
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
        $data = Tiket::find($id);
        if($data){
            return $data;
        }else{
            return ["message" => "Data tidak ditemukan"];
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
        $update = Tiket::where('id', $id)->update($request->all());
        if ($update) {
            return response([
                'status' => 200,
                'message' => 'Data berhasil diubah',
            ], 200);
        }else{
            return response([
                'status' => 400,
                'message' => 'Data gagal diubah',
            ], 400);
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
        $data = Tiket::find($id);
        if($data){
            $data->delete();
            return ["message" => "Data berhasil dihapus"];
        }else{
            return ["message" => "Data gagal dihapus"];
        }
    }
}
