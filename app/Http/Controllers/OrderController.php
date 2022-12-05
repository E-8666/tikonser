<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Tiket;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::all();
        return response()->json([
            "message" => "Load data success",
            "data" => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function byid($id)
    {
        $data = Order::find($id);
        if($data){
            return $data;
        }else{
            return ["message" => "Data not found"];
        }
    }

    public function byuser($id)
    {
        $data = Order::where('id_customer', $id)->get();
        if($data){
            return $data;
        }else{
            return ["message" => "Data not found"];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {
        $id_tiket = $request->id_tiket;
        $data_tiket = Tiket::where('id', $id_tiket)->first();
        $tiket = Tiket::where('id', $id_tiket)->update([
        "stock" => $data_tiket->stock-$request->jumlah_tiket
        ]);

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 10;

        $code = '';

        while (strlen($code) < 10) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (Order::select('kode_reedem')->where('kode_reedem', $code)->exists()) {
            $this->generateUniqueCode();
        }

        //'kode_reedem', 'id_customer', 'id_tiket', 'status', 'harga'
        $data = Order::create([
            "kode_reedem" => $code,
            "id_customer" => $request->id_customer,
            "id_tiket" => $request->id_tiket,
            "jumlah_tiket" => $request->jumlah_tiket,
            "status" => 'belum dibayar',
            "jumlah_harga" => $data_tiket->harga*$request->jumlah_tiket,

        ]);

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
    public function pay(Request $request, $id)
    {
        $update = Order::where('id', $id)->update([
            "status" => "Telah Dibayar"
        ]);
        if ($update) {
            return response([
                'status' => 200,
                'message' => 'Tiket Telah Dibayar',
            ], 200);
        }else{
            return response([
                'status' => 400,
                'message' => 'Data gagal diubah',
            ], 400);
        }
    }

    public function reedem(Request $request, $id)
    {
        $tiket = Order::where('kode_reedem', $id)->first();
        if( $tiket->status == 'Telah Dibayar')
        {
            $update = Order::where('id', $tiket->id)->update([
                "status" => "Berhasil ditukar"
            ]);

            return response([
                'status' => 200,
                'message' => 'Tiket berhasil ditukar',
            ], 200);

        }else{
            return response([
                'status' => 400,
                'message' => 'Gagal ditukar',
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
        //
    }
}
