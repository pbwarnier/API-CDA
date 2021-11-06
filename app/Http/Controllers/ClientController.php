<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class ClientController extends Controller
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

    // GESTION DES CLIENTS

    // AJOUTER UN CLIENT
    public function addClient(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required',
                'adress' => 'required',
                'phone' => 'required',
                'type' => 'required'
            ]);
            if ($validator->fails()) {
                    return response()->json(['status' => 'Failed' ,'state'=>'100' , 'message'=> $validator->errors()->first() ], 401);
            } else {
                    $client = Client::create($request->all());
                    return response()->json($client, 201);
            }
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // MISE A JOUR D'UN CLIENT EN FONCTION DE SON ID
    public function updateClient($id, Request $request){
        try {
            $this->validate($request, [
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required',
                'adress' => 'required',
                'phone' => 'required',
                'type' => 'required'
                ]);

            $client = Client::findOrFail($id);
            $client->update($request->json()->all());

        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // RECUPERER LA LISTE DES CLIENTS
    public function getClientList(Request $request){
        $filter = $request->input('filter');
        try {
            $result = DB::table('clients')
                ->orderBy('lastname', 'asc')
                ->where('lastname', 'LIKE', "%$filter%") 
                ->orWhere('firstname', 'LIKE', "%$filter%")
                ->orWhere('email', 'LIKE', "%$filter%")
                ->orWhere('adress', 'LIKE', "%$filter%")
                ->orWhere('phone', 'LIKE', "%$filter%")
                ->get();
            return $result;
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // RECUPERER UN CLIENT EN FONCTION DE SON ID 
    public function getClient($id){
        try {
            return Client::findOrFail($id);
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }   
    }
}