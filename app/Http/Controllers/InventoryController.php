<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function getInventoriesList()
    {
        return response()->json(Inventory::all());
    }

    public function getInventory($id)
    {
        return response()->json(Inventory::find($id));
    }

    public function addInventory(Request $request)
    {
        try{
            $this->validate($request, [
                'date' => 'required|date',
                'data' => 'required|string',
            ]);

            $inventory = Inventory::create($request->json()->all());
            return response()->json($inventory, 201);
        }
        catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public function updateInventory($id, Request $request)
    {
        try{
            $inventory = Inventory::findOrFail($id);
            $inventory->update($request->json()->all());
            return response()->json($inventory, 201);
        }
        catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->json()->all());

        return response()->json($inventory, 200);
    }
}