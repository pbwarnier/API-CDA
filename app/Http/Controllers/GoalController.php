<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    public function getGoalsList()
    {
        $goal = DB::table('goals')
            ->join('users', 'users.id_users', '=', 'goals.id_users')
            ->get(['goals.id_goals', 'goals.title', 'goals.end_date', 'goals.description', 'goals.id_users', 'goals.id_type', 'goals.title', 'users.lastname', 'users.firstname' ]);

        return response()->json($goal);
    }

    public function GetGoal($id)
    {
        try{
            //si l'objectif est trouvé, on affiche
            //sinon on retourne un message et un code d'erreur
            $goal = Goal::findOrFail($id);
            return response()->json($goal, 200);
        }
        //antislash pour ne pas interpreter l'exception comme un namespace
        catch(\Exception $e) {
            return response()->json('Aucun objectif trouvé', 404);
        }
    }

    public function addGoal(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'end_date' => 'required|date',
            'description' => 'required',
            'id_users' => 'required|regex:/^\d{1,}$/i',
            'id_type' => 'required|regex:/^\d{1,}$/i'
        ]);

        try{
            //insert method
            $goal = Goal::create($request->json()->all());
            return response()->json('Votre nouvel objectif est enregistré', 200);
        }
        catch(\Exception $e) {
            return response()->json('Une erreur est survenue lors de l\'enregistrement '.$e, 500);
        }
    }

    public function updateGoal($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'end_date' => 'required|date',
            'description' => 'required',
            'id_users' => 'required|regex:/^\d{1,}$/i',
            'id_type' => 'required|regex:/^\d{1,}$/i',
        ]);

        try{
            //trouve l'id à modifier ou envoie une erreur
            $goal = Goal::findOrFail($id);
            $goal->update($request->json()->all());
            return response()->json('Votre objectif à été modifié', 200);
        }
        catch(Exception $e) {
            return response()->json('Une erreur est survenue lors de l\'enregistrement', 500);
        }
    }

    public function deleteGoal($id)
    {
        Goal::findOrFail($id)->delete();
        return response('Supprimé avec succès', 200);
    }
}
