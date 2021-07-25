<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Financeiro;


class Pagamentos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $clients = Financeiro::all();
        $payments = Pagamento::all();
        foreach($payments as $payment){
            foreach($clients as $client){
              if($payment['client'] == $client['id']){
                  $payment['client'] = $client['name'];
              }
            }
        }
        return $payments;
    }

    public function indexView()
    {
        $clients = Financeiro::all();
        return view('payments', compact(['clients']));
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
        $payment = new Pagamento();
        $payment->client = $request->input('client'); $payment->date = $request->input('date');
        $payment->price = $request->input('price');$payment->status = $request->input('status');
        $payment->save();
        return json_encode($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Pagamento::find($id);
        if(isset($payment)){
            return json_encode($payment);
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
        $payment = Pagamento::find($id);
        if(isset($payment)) {
            $payment->status = $request->input('status');
            $payment->save();
        }
        return json_encode($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletePayment = Pagamento::find($id);
        if(isset($deletePayment)){
            $deletePayment->delete();
        }
    }
}
