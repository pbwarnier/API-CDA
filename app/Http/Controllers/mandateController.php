<?php

namespace App\Http\Controllers;

use App\Models\Mandate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MandateController extends Controller
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
    //GESTION DES MANDATS

    // RECUPERER LA LISTE DE TOUT LES MANDATS
    public function getMandateList(){
        try {
            return Mandate::get();
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // RECUPERER UN MANDAT EN FONCTION DE SON ID
    public function getMandate($id){
        try {
            return Mandate::findOrFail($id);
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // AJOUTER UN MANDAT
    public function addMandate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'id_clients' => 'required',
                'id_users' => 'required',
                'id_documents' => 'required'
            ]);
            if ($validator->fails()) {
                    return response()->json(['status' => 'Failed' ,'state'=>'100' , 'message'=> $validator->errors()->first() ], 401);
            } else {
                    $mandate = Mandate::create($request->all());
                    return response()->json($mandate, 201);
            }
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // MISE A JOUR D'UN MANDAT EN FONCTION DE SON ID
    public function updateMandate($id, Request $request){
        try {
            $this->validate($request, [
                'name' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'id_clients' => 'required',
                'id_users' => 'required',
                'id_documents' => 'required'
                ]);

            $mandate = Mandate::findOrFail($id);
            $mandate->update($request->json()->all());

        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // SUPPRIMER UN MANDAT EN FONCTION DE SON ID
    public function deleteMandate($id){
        try{
            Mandate::findOrFail($id)->delete();
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

}