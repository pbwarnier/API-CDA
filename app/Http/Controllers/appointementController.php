<?php

namespace App\Http\Controllers;

use App\Models\Appointement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppointementController extends Controller
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
    //GESTION DES RDV

    // RECUPERER LA LISTE DE TOUT LES RENDEZ-VOUS D'UN UTILISATEUR
    public function getAppointementList(request $request){
        try {
            $user = Auth::id();
            $date = $request->input('date');
            $appointements = DB::table('appointements')
                ->where('id_users', $user)
                ->where('date', $date)
                ->join('users', 'users.id_users', '=', 'appointements.user_id')
                ->get(['appointements.id_appointements', 'appointements.title', 'appointements.date', 'appointements.description', 'users.lastname', 'users.firstname' ]);

            return response()->json($appointements);
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    public function getUserAppointement(request $request){
        try {
            $user = Auth::id();
            $appointements = DB::table('appointements')
                ->where('id_users', $user)
                ->join('users', 'users.id_users', '=', 'appointements.user_id')
                ->get(['appointements.id_appointements', 'appointements.title', 'appointements.date', 'appointements.description', 'users.lastname', 'users.firstname' ]);
            return response()->json($appointements);
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // RECUPERER UN RENDEZ-VOUS EN FONCTION DE SON ID
    public function getAppointement($id){
        try {
            return Appointement::findOrFail($id);
        } catch(Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    // AJOUTER UN RENDEZ-VOUS
    public function addAppointement(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'date' => 'required',
                'description' => 'required'
            ]);
            if ($validator->fails()) {
                    return response()->json(['status' => 'Failed' ,'state'=>'100' , 'message'=> $validator->errors()->first() ], 401);
            } else {
                    $appointement = Appointement::create($request->all());
                    return response()->json($appointement, 201);
            }
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // MISE A JOUR D'UN RENDEZ-VOUS EN FONCTION DE SON ID
    public function updateAppointement($id, Request $request){
        try {
            $this->validate($request, [
                'title' => 'required',
                'date' => 'required',
                'description' => 'required'
                ]);

            $appointement = Appointement::findOrFail($id);
            $appointement->update($request->json()->all());

        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // SUPPRIMER UN RENDEZ VOUS EN FONCTION DE SON ID
    public function deleteAppointement($id){
        try{
            Appointement::findOrFail($id)->delete();
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}
