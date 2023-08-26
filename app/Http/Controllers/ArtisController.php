<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artis; // Make sure to import the Category model

class ArtisController extends Controller
{
    public function index()
    {
        try {
            $artis = Artis::all();

            return response()->json(['message' => 'Artis showing successfully', 'data' => $artis], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function detail($id)
    {
         try {
            $artis = Artis::findOrFail($id);

            return response()->json(['message' => 'Artis showing successfully', 'data' => $artis], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

  public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:kategori|max:255'
        ]);

        try {
            $artis = Artis::create($data);

            return response()->json(['message' => 'Artis created successfully', 'data' => $artis], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $artis = Artis::findOrFail($id);

         try {
            $data = $request->validate([
                'name' => 'required|unique:artis,name,' . $id . '|max:255'
            ]);

            $artis->update($data);

            return response()->json(['message' => 'Artis Updated successfully', 'data' => $artis], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $artis = Artis::findOrFail($id);
        
         try {

           $artis->delete();

            return response()->json(['message' => 'Artis Deleted successfully', 'data' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    
    }
}