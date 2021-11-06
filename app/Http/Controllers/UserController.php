<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }
    //GESTION DES UTILISATEURS

    // RECUPERER LA LISTE DE TOUT LES UTILISATEURS
    public function getUsersList(){
        return User::get();
    }

    // // AJOUTER UN UTILISATEUR
    // public function addUser(Request $request) {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'lastname' => 'required|unique:users',
    //             'firstname' => 'required|unique:users',
    //             'email' => 'required',
    //             'password' => 'required',
    //             'phone' => 'required',
    //             'id_role' => 'required'
    //         ]);
    //         if ($validator->fails()) {
    //             $request['password'] = app('hash')->make('password');
    //             return response()->json(['status' => 'Failed' ,'state'=>'100' , 'message'=> $validator->errors()->first() ], 401);
    //         }else {
    //             $user = User::create(request->json()->all());
    //             return response()->json(['status' => 'success' ,'state'=>'201' , 'message'=> $user ], 201);
    //         }

    // RECUPERER UN UTILISATEUR EN FONCTION DE SON ID
    public function getUser($id){
        return User::findOrFail($id);
    }

    // get all users (agent)
    public function getAllAgents(){
        try {
            $agents = DB::table('users')
            ->where('users.id_role', '=', 2)
                ->get(['users.lastname', 'users.firstname', 'users.email', 'users.phone', 'users.id_role']);
            return response()->json($agents);
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

    }

    // AJOUTER UN UTILISATEUR
    public function addUser(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|unique:users',
                'lastname' => 'required|unique:users',
                'email' => 'required',
                'password' => 'required',
                'id_role' => 'required',
                'phone' => 'required'
            ]);
            if ($validator->fails()) {
                $request['password'] = app('hash')->make('password');
                return response()->json(['status' => 'Failed' ,'state'=>'100' , 'message'=> $validator->errors()->first() ], 401);
            }else {
                $request['password'] = app('hash')->make('password');
                $user = User::create($request->json()->all());
                return response()->json(['status' => 'success' ,'state'=>'201' , 'message'=> $user ], 201);
            }

        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // METTRE A JOUR UN UTILISATEUR EN FONCTION DE SON ID
    public function updateUser($id, Request $request) {
        try {
            $this->validate($request, [
                'lastname' => 'required',
                'firstname' => 'required|unique:users',
                'email' => 'required',
                'phone' => 'required'
                ]);

            $user = User::findOrFail($id);
            $user->update($request->json()->all());
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}
