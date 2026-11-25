<?php

namespace App\Http\Controllers;

use App\Models\LookbookModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class LookbookFeatureController extends Controller
{
    public function home(Request $request)
    {
        $products = collect();

        if (Schema::hasTable('products')) {
            $query = DB::table('products')->latest('id');

            if ($request->filled('search')) {
                $search = '%' . $request->input('search') . '%';
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', $search)
                        ->orWhere('color', 'like', $search)
                        ->orWhere('material', 'like', $search);
                });
            }

            if ($request->filled('category')) {
                $query->where('category', $request->input('category'));
            }

            if ($request->filled('collection_id')) {
                $query->where('collection_id', $request->input('collection_id'));
            }

            $products = $query->get();
        }

        $collections = Schema::hasTable('collections')
            ? DB::table('collections')->orderBy('name')->get()
            : collect();

        $collectionMap = $collections->keyBy('id');
        $products = $products->map(function ($item) use ($collectionMap) {
            if (!isset($item->collection) && isset($item->collection_id) && isset($collectionMap[$item->collection_id])) {
                $item->collection = $collectionMap[$item->collection_id];
            }
            if (!isset($item->is_limited)) {
                $item->is_limited = 0;
            }
            return $item;
        });

        $models = Schema::hasTable('lookbook_models')
            ? LookbookModel::latest()->get()
            : collect();

        return view('welcome', compact('products', 'collections', 'models'));
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.products.index');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Schema::hasTable('users') && User::count() === 0) {
            User::create([
                'name' => 'Pirda Admin',
                'email' => 'pirdaadmin@lookbook.catalog',
                'password' => Hash::make('04272010'),
            ]);
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.products.index'))
                ->with('success', 'Berhasil login ke Admin Panel.');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Kamu sudah logout.');
    }

    public function adminIndex()
    {
        $products = collect();

        if (Schema::hasTable('products')) {
            $products = DB::table('products')->latest('id')->get();
        }

        $collections = Schema::hasTable('collections')
            ? DB::table('collections')->orderBy('name')->get()
            : collect();

        $collectionMap = $collections->keyBy('id');
        $products = $products->map(function ($item) use ($collectionMap) {
            if (!isset($item->collection) && isset($item->collection_id) && isset($collectionMap[$item->collection_id])) {
                $item->collection = $collectionMap[$item->collection_id];
            }
            if (!isset($item->is_limited)) {
                $item->is_limited = 0;
            }
            return $item;
        });

        $models = Schema::hasTable('lookbook_models')
            ? LookbookModel::latest()->get()
            : collect();

        return view('admin.features', compact('products', 'collections', 'models'));
    }

    public function storeProduct(Request $request, bool $forceLimited = false)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'category' => ['nullable', 'string', 'max:100'],
            'collection_id' => ['nullable'],
            'size' => ['nullable', 'string', 'max:50'],
            'color' => ['nullable', 'string', 'max:100'],
            'material' => ['nullable', 'string', 'max:120'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['required', 'image', 'max:4096'],
            'is_limited' => ['nullable'],
        ]);

        if (!Schema::hasTable('products')) {
            return back()->withErrors(['name' => 'Tabel products belum tersedia.']);
        }

        $imagePath = $request->file('image')->store('products', 'public');
        $isLimited = $forceLimited || $request->boolean('is_limited');

        $payload = [
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (Schema::hasColumn('products', 'collection_id')) {
            $collectionId = $data['collection_id'] ?? null;

            if (empty($collectionId) && Schema::hasTable('collections')) {
                $firstCollection = DB::table('collections')->orderBy('id')->first();

                if ($firstCollection) {
                    $collectionId = $firstCollection->id;
                } else {
                    $insertData = ['name' => 'General'];
                    if (Schema::hasColumn('collections', 'slug')) {
                        $insertData['slug'] = 'general';
                    }
                    if (Schema::hasColumn('collections', 'created_at')) {
                        $insertData['created_at'] = now();
                    }
                    if (Schema::hasColumn('collections', 'updated_at')) {
                        $insertData['updated_at'] = now();
                    }
                    $collectionId = DB::table('collections')->insertGetId($insertData);
                }
            }

            if (!empty($collectionId)) {
                $payload['collection_id'] = $collectionId;
            }
        }

        if (Schema::hasColumn('products', 'category')) {
            $payload['category'] = $data['category'] ?? 'Atasan';
        }
        if (Schema::hasColumn('products', 'size')) {
            $payload['size'] = $data['size'] ?? 'All Size';
        }
        if (Schema::hasColumn('products', 'color')) {
            $payload['color'] = $data['color'] ?? '-';
        }
        if (Schema::hasColumn('products', 'material')) {
            $payload['material'] = $data['material'] ?? '-';
        }
        if (Schema::hasColumn('products', 'is_limited')) {
            $payload['is_limited'] = $isLimited ? 1 : 0;
        }

        DB::table('products')->insert($payload);

        return back()->with(
            'success',
            $isLimited
                ? 'Item Limited Edition baru berhasil ditambahkan!'
                : 'Item Catalog baru berhasil ditambahkan!'
        );
    }

    public function storeLimitedProduct(Request $request)
    {
        return $this->storeProduct($request, true);
    }

    public function destroyProduct($id)
    {
        if (Schema::hasTable('products')) {
            $product = DB::table('products')->where('id', $id)->first();
            if ($product && !empty($product->image) && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            DB::table('products')->where('id', $id)->delete();
        }

        return back()->with('success', 'Item produk berhasil dihapus.');
    }

    public function toggleLimited($id)
    {
        if (Schema::hasTable('products') && Schema::hasColumn('products', 'is_limited')) {
            $product = DB::table('products')->where('id', $id)->first();
            if ($product) {
                DB::table('products')->where('id', $id)->update([
                    'is_limited' => empty($product->is_limited) ? 1 : 0,
                    'updated_at' => now(),
                ]);
            }
        }

        return back()->with('success', 'Status Limited Edition baju berhasil diperbarui.');
    }

    public function storeModel(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'detail' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:4096'],
        ]);

        $imagePath = $request->file('image')->store('models', 'public');

        LookbookModel::create([
            'name' => $data['name'],
            'detail' => $data['detail'] ?? '-',
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Model baru berhasil ditambahkan ke List Model.');
    }

    public function destroyModel($id)
    {
        $model = LookbookModel::findOrFail($id);
        if ($model->image && Storage::disk('public')->exists($model->image)) {
            Storage::disk('public')->delete($model->image);
        }
        $model->delete();

        return back()->with('success', 'Data model berhasil dihapus.');
    }
}