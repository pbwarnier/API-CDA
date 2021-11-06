<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function getPropertiesList()
    {
        try {
            return Property::get();
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public function getProperty($id)
    {
        try{
            //$property = Property::findOrFail($id);
            $property = DB::table('properties')
                                ->join('clients', 'properties.id_clients', '=', 'clients.id_clients')
                                ->select('properties.*' ,'clients.lastname', 'clients.firstname')
                                ->where('properties.id_properties', '=', $id)
                                ->get();

            return response()->json($property[0], 200);
        }
        catch(\Exception $e) {
            return response()->json('Aucune propriété trouvée', 404);
        }
    }

    public function addProperty(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|regex:/^\d{1,}$/i',
            'reference' => 'unique:properties',
            'nb_room' => 'required|regex:/^\d{1,}$/i',
            'description' => 'required',
            'area' => 'required|regex:/^\d{1,}$/i',
            'type' => 'required',
            'rental_expenses' => 'required_unless: type, location',
            'availability' => 'required|boolean',
            'country' => 'required|string',
            'zip_code' => 'required|size:5',
            'city' => 'required|string',
            'adress' => 'required|string',
            'furniture' => 'required|boolean',
            'garage' => 'required|boolean',
            'garden' => 'required|boolean',
            'energy_class' => 'required|integer'
        ]);

        try{
            $property = Property::create($request->json()->all());
            return response()->json('Votre annonce est enregistrée', 201);
        }
        catch(Exception $e) {
            return response()->json('Une erreur est survenue lors de l\'enregistrement', 500);
        }
    }

    public function updateProperty($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|regex:/^\d{1,}$/i',
            'reference' => 'unique:properties',
            'nb_room' => 'required|regex:/^\d{1,}$/i',
            'description' => 'required',
            'area' => 'required|regex:/^\d{1,}$/i',
            'type' => 'required',
            'rental_expenses' => 'nullable|required_unless: type, location',
            'availability' => 'required|boolean',
            'country' => 'required|string',
            'zip_code' => 'required|size:5',
            'city' => 'required|string',
            'adress' => 'required|string',
            'furniture' => 'required|boolean',
            'garage' => 'required|boolean',
            'garden' => 'required|boolean',
            'energy_class' => 'required|string|size:1'
        ]);

        try{
            //trouve l'id à modifier ou envoie une erreur
            $property = Property::findOrFail($id);
            $property->update($request->json()->all());
            return response()->json('Les informations de la propriété ont été modifiés', 200);
        }
        catch(Exception $e) {
            return response()->json('Une erreur est survenue lors de l\'enregistrement', 500);
        }
    }

    public function deleteProperty($id)
    {
        Property::findOrFail($id)->delete();
        return response('Supprimé avec succès', 200);
    }
}
