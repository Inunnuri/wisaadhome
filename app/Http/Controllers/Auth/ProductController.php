<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class ProductController extends Controller
{
     // 2. Menampilkan produk milik pengguna yang sedang login
     public function index()
     {
        $user = Auth::user();
         $userProducts = Product::where('user_id', $user->id)->get();
         $title = 'Your Product';
         $products = $user->products;
         return view('product', compact('userProducts','title','products'));
     }





     //3. menampilkan form
    public function showProductForm()
    {
        $user = Auth::user();

       // Cek apakah user sudah terdaftar, jika belum arahkan ke halaman registrasi
       if (!$user) {
        return redirect()->route('register');
    }

        // Ambil semua produk yang dimiliki oleh pengguna saat ini melalui relasi
         $products = $user->products;
         $title = 'Your Product';

     return view('product', compact('products', 'title'));
    }





    //4. untuk menambah product
    public function add(Request $request)
    {
        Log::info('Request data: ', $request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_id' => 'required|exists:jenis,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|int',
            'alamat' => 'required|string|max:255',
            'description' => 'required|string|max:1255',
            'post_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('register');
        }

        $product = new Product();
        $product->user_id = $user->id; // Simpan ID pengguna


       // Handle file upload
       if ($request->hasFile('post_photo')) {
        $file = $request->file('post_photo');
        Log::info('File uploaded:', ['file' => $file]);
    
        if ($file->isValid()) {
            $filePath = $file->store('post_photos', 'public');
            Log::info('File stored at:', ['filePath' => $filePath]);
            $product->post_photo = $filePath;
        } else {
            Log::warning('Uploaded file is not valid.');
            return back()->withErrors(['post_photo' => 'Uploaded file is not valid.']);
        }
    } else {
        Log::warning('No file uploaded.');
    }
    
      
        // add product pengguna dengan data yang valid
        $product->fill($request->only([
            'nama', 'jenis_id', 'price','category_id', 'alamat', 'description'
        ]));


        //Menyimpan post ke database.
        $product->save();
        Log::info('Product saved successfully');

        return redirect()->route('product.index')->with('success', 'Update Product successfully!');
}




//5. mengedit product
public function edit(Request $request, $id)
{
    Log::info('Request data: ', $request->all());
    $request->validate([
        'nama' => 'required|string|max:255',
        'jenis_id' => 'required|exists:jenis,id',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|int',
        'alamat' => 'required|string|max:255',
        'description' => 'required|string|max:1255',
        'post_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Mendapatkan pengguna yang sedang login
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('register');
    }

    // Cari produk berdasarkan ID
    $product = Product::find($id);
    if (!$product || $product->user_id != $user->id) {
        return redirect()->route('product.index')->with('error', 'Produk tidak ditemukan atau Anda tidak memiliki akses.');
    }
    
   // Handle file upload
   if ($request->hasFile('post_photo')) {
    $file = $request->file('post_photo');
    Log::info('File uploaded:', ['file' => $file]);

    if ($file->isValid()) {
        $filePath = $file->store('post_photos', 'public');
        Log::info('File stored at:', ['filePath' => $filePath]);
        $product->post_photo = $filePath;
    } else {
        Log::warning('Uploaded file is not valid.');
        return back()->withErrors(['post_photo' => 'Uploaded file is not valid.']);
    }
} else {
    Log::warning('No file uploaded.');
}

  
    // add product pengguna dengan data yang valid
    $product->fill($request->only([
        'nama', 'jenis_id', 'category_id','price', 'alamat', 'description'
    ]));


    //Menyimpan post ke database.
    $product->save();
    Log::info('Product saved successfully');

    return redirect()->route('product.index')->with('success', 'Update Product successfully!');
}





//6. menghapus product
public function destroy($id)
{
    Log::info("Destroy method called for product ID: $id");
    
    $product = Product::find($id);
    
    if (!$product) {
        Log::error("Product not found with ID: $id");
        return response()->json(['success' => false]);
    }

    if ($product->user_id !== Auth::id()) {
        Log::error("User is not authorized to delete product ID: $id");
        return response()->json(['success' => false]);
    }

    $product->delete();
    Log::info("Product deleted successfully: $id");
    return response()->json(['success' => true]);
}
}

// done