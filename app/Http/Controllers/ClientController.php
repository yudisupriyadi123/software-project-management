<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Session;
use App\Client;
use App\ClientEmail;
use App\ClientPhone;
use App\ClientType;

class ClientController extends Controller
{
    public function index()
    {
        return view('prospect.prospect-list');
    }

    public function getProspect()
    {
        $prospect = Client::join('client_types','clients.client_type_id','=','client_types.id')
        ->join('client_phones','clients.id','=','client_phones.client_id')
        ->join('client_emails','clients.id','=','client_emails.client_id')
        ->select([
            'clients.id as id',
            'clients.photo as photo',
            'clients.name as name',
            'client_types.name as type',
            'client_phones.phone as phone',
            'client_emails.email as email',
            'clients.business_relationship_status as status_hub'
        ])->where('clients.status','=','prospect')->get();
        // $prospect = Client::with(['client_types','client_phones','client_emails'])->get();

        return Datatables::of($prospect)
        ->addColumn('options',function($prospect){
            return '<div class="text-center"><div class="item-action dropdown"><a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a><div class="dropdown-menu dropdown-menu-right"><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Termin Pembayaran </a><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Progress Tracker</a><div class="dropdown-divider"></div><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a></div></div></div>';
        })->rawColumns(['options'])->make(true);
    }

    public function newProspectType()
    {
        $listProspectTypes = ClientType::get();
        return view('prospect.new-prospect-types',['listProspectTypes'=>$listProspectTypes]);
    }

    public function newProspectForm()
    {
        return view('prospect.new-prospect-form');
    }

    public function getProspectType(Request $req)
    {
        //get parameter
        $idType = $req->getQueryString();
        //get value type id
        $valueId  = $req->input('prospect_type_id');
       
        $clientType = CLientType::where('id','=',$valueId)->first();
        if (!str_contains($idType,'prospect_type_id'))
        {
            Session::flash('message', 'Pilih type prospect dahulu !!!'); 
            Session::flash('alert-class', 'alert-warning'); 

            return redirect('/client/new/prospect-types');
        }

        return view('prospect.new-prospect-form',['idType'=>$clientType]);
    }

    public function createProspectForm(\App\Http\Requests\StoreProspect $req)
    {
        // $data = $req->all();
        // print_r($data);
        // $prospect = Client::create($request->except(''))
        $prospect = new Client();
        $prospect->client_type_id   = $req->tipeProspect;
        $prospect->name             = $req->nama;
        $prospect->business_relationship_status = $req->statusHub;
        if($req->has('photo'))
        {
            $prospectImage = $req->file('photo');
            dd($prospectImage);
        }
        // $prospect->photo = 'test';
        $prospect->status   = $prospect->getStatusTextAttribute(Client::IS_PROSPECT);
        $prospect->save();

        $prospect->address()->create(['address'=>$req->alamat]);

        foreach ($req->kota as $kota) {
            $prospect->city()->create(['city' => $kota]);
        }

        foreach ($req->email as $email) {
            $prospect->email()->create(['email' => $email]);
        }

        foreach ($req->norek as $norek) {
            $prospect->bankAccount()->create(['bank_account' => $norek]);
        }

        foreach ($req->web as $web) {
            $prospect->webAddress()->create(['web_addresses' => $web]);
        }
 

    }
}
