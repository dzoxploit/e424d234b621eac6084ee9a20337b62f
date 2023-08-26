<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori; // Make sure to import the Category model

class KategoriController extends Controller
{
    public function index()
    {
         try {
            $category = Kategori::all();

            return response()->json(['message' => 'Kategori showing successfully', 'data' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function detail($id)
    {
         try {
            $category = Kategori::findOrFail($id);

            return response()->json(['message' => 'Kategori showing successfully', 'data' => $category], 201);
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
            $category = Kategori::create($data);

            return response()->json(['message' => 'Category created successfully', 'data' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $category = Kategori::findOrFail($id);

         try {
            $data = $request->validate([
                'name' => 'required|unique:kategori,name,' . $id . '|max:255'
            ]);

            $category->update($data);

            return response()->json(['message' => 'Artis Updated successfully', 'data' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $category = Kategori::findOrFail($id);
        
         try {

           $category->delete();

            return response()->json(['message' => 'Artis Deleted successfully', 'data' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    
    }
}