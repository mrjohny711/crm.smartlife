<?php

namespace App\Http\Controllers;

use App\Upsheet;
use App\Http\Requests\UpsheetRequest;
use App\Operator;
use App\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Laracasts\Flash\Flash;

class UpsheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agency_id=Input::get('agency_id');
        $seller_id=Input::get('seller_id');
        $manager_id=Input::get('manager_id');
        $supervisor_code=Input::get('supervisor_code');
        $operator_code=Input::get('operator_code');
        $ds=Input::get('ds');
        $de=Input::get('de');
        $appends = collect();
        $clients = $this->get_clients($agency_id, $seller_id, $manager_id, $supervisor_code, $operator_code, $ds, $de, $appends)->paginate(15);
        $clients = $clients->appends($appends->toArray());
        return view('admin.upsheet.index', compact('clients', 'agency_id','seller_id', 'manager_id', 'supervisor_code', 'operator_code', 'ds', 'de'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.upsheet.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpsheetRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpsheetRequest $request)
    {
        $upsheet = $request->upsheet;
        $voucher = $upsheet["voucher_type"].$upsheet["voucher_code"];
        if($upsheet["to_id"] == 1){
            $to = "Sim";
        } else{
            $to = "Não";
        }
        if($upsheet["close"] == 1){
            $close = "Sim";
        } else {
            $close = "Não";
        }
        $upsheet=array_except($upsheet, array('voucher_type', 'voucher_code', 'to_id', 'close'));
        $upsheet=array_add($upsheet, 'voucher', $voucher);
        $upsheet=array_add($upsheet, 'to', $to);
        $upsheet=array_add($upsheet, 'close', $close);
        Upsheet::create($upsheet);
        flash('Upsheet Inserido Com Sucesso!!!')->important()->success();
        return redirect()->back();
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
        $client = Upsheet::FindOrFail($id);
        return view('admin.upsheet.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpsheetRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpsheetRequest $request, $id)
    {
        $client = Upsheet::FindOrFail($id);
        $client->update($request->client);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Upsheet::findOrFail($id);
        $client->delete();
        return redirect()->back();
    }

    /**
     * @param $agency_id
     * @param $seller_id
     * @param $manager_id
     * @param $supervisor_code
     * @param $operator_code
     * @param $ds
     * @param $de
     * @param $appends
     * @param bool $export
     * @return
     */
    function get_clients($agency_id, $seller_id, $manager_id, $supervisor_code, $operator_code, $ds, $de, &$appends, $export=false){
        $clients=Upsheet::orderBy('first_holder_name');
        if($agency_id != null){
            $clients = $clients->where('agency_id', $agency_id);
            if(!$export)
                $appends->put('agency_id', $agency_id);
        }
        if($seller_id != null){
            $clients = $clients->where('seller_id', $seller_id);
            if(!$export)
                $appends->put('seller_id', $seller_id);
        }
        if($manager_id != null){
            $clients = $clients->where('manager_id', $manager_id);
            if(!$export)
                $appends->put('manager_id', $manager_id);
        }
        if($supervisor_code != null){
            $supervisor = Supervisor::where('code', $supervisor_code)->first();
            $clients = $clients->where('supervisor_id', $supervisor->id);
            if(!$export)
                $appends->put("supervisor_code", $supervisor_code);
        }
        if($operator_code != null){
            $operator = Operator::where('code', $operator_code)->first();
            $clients = $clients->where('operator_id', $operator->id);
            if(!$export)
                $appends->put("operator_code" , $operator_code);
        }
        if($ds != '' && $de !=''){
            $clients = $clients->whereDate('visit_date','>=',$ds)->whereDate('visit_date', '<=', $de);
            if(!$export){
                $appends->put("ds", $ds);
                $appends->put("de", $de);
            }
        }
        return $clients;
    }

    function options_append($agency_id, $seller_id, $manager_id, $supervisor_code, $operator_code, $ds, $de){
        $appends = collect();
        if($agency_id != null){
            $appends->put("agency_id",$agency_id);
        }
        if($seller_id != null){
            $appends->push(["seller_id" => $seller_id]);
        }
        if($manager_id != null){
            $appends->push(["manager_id" => $manager_id]);
        }
        if($supervisor_code != null){
            $appends->push(["supervisor_code" => $supervisor_code]);

        }
        if($supervisor_code != null){
            $appends->push(["supervisor_code" => $supervisor_code]);
        }
        if($operator_code != null){
            $appends->push(["operator_code" => $operator_code]);
        }
        if($ds != '' && $de !=''){
            $appends->push(["ds" => $ds]);
            $appends->push(["de" => $de]);
        }
        return $appends->toArray();
    }
}
