<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = CategoryProduct::all();

        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new CategoryProduct;

        return view('admin.category.form', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = new CategoryProduct();
            $data->name = $request->name;
            $data->save();

            return redirect()
                ->route('category.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = CategoryProduct::query()->findOrFail($id);

        return view('admin.category.form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = CategoryProduct::query()->findOrFail($id);
            $data->name = $request->name;
            $data->save();

            return redirect()
                ->route('category.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cek apakah kategori digunakan oleh produk
        $products = Product::where('category_id', $id)->exists();

        if ($products) {
            // Jika kategori digunakan oleh produk, tampilkan pesan error
            return redirect()->back()->with('error', 'Kategori ini masih digunakan oleh beberapa produk dan tidak dapat dihapus.');
        }

        // Jika kategori tidak digunakan oleh produk, hapus kategori
        $post = CategoryProduct::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('message', 'Kategori berhasil dihapus');
    }
}
