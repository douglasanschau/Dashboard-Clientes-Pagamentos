<?php

namespace App\Http\Controllers;

use App\Models\Financeiro;
use Illuminate\Http\Request;

class Clientes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Financeiro::all();
        return $clientes;
    }

    public function indexOne()
    {
        return view('dashboard');
    }

    public function indexTwo()
    {
        return view('clients');
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
        $newClient = new Financeiro();
        $newClient->name = $request->input('name'); $newClient->status = $request->input('status');
        $newClient->save();
        return json_encode($newClient);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Financeiro::find($id);
        if(isset($client)){
            return json_encode($client);
        } else{
            return response ("Cliente não encontrado", 404);
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
        $client = Financeiro::find($id);
        if(isset($client)){
            $client->name = $request->input('name'); $client->status = $request->input('status');
            $client->save();
        }

        return json_encode($client);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteClient = Financeiro::find($id);
        if(isset($deleteClient)){
            $deleteClient->delete();
        } else {
            return response('Cliente não encontrado', 404);
        }
    }
}
