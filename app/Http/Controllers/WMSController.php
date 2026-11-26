<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\suppliers;
use App\Models\Staff;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Customer;
use App\Models\Sale;
use  App\Models\cat;

class WMSController extends Controller
{
    // Admin Products page
    // public function showproduct()
    // {
    //     $data = Product::latest()->get();

    //     return view('admindashboard.adminproduct', compact('data'));
    // }
    public function showproduct()
    {
        $data = Product::latest()->get();

        return view('admindashboard.adminproduct', compact('data'));
    }
    public function editproduct($id)
    {
        $product = Product::findOrFail($id);

        return view('admindashboard.editproduct', compact('product'));
    }
    public function index()
    {
        $activeProducts = DB::table('products')->count();
        $totalPurchases = DB::table('purchases')->count();
        $totalSales = DB::table('sales')->count();

        return view('public.home', compact(
            'activeProducts',
            'totalPurchases',
            'totalSales'
        ));
    }
    // Save multiple products from one form
    public function createproduct(Request $r)
    {
        $r->validate([
            'products' => ['required', 'array', 'min:1'],

            'products.*.product_code' => [
                'required',
                'string',
                'max:100',
                'distinct',
                Rule::unique('products', 'product_code'),
            ],

            'products.*.product_name' => ['required', 'string', 'max:255'],
            'products.*.category' => ['nullable', 'string', 'max:255'],
            'products.*.sub_category' => ['nullable', 'string', 'max:255'],
            'products.*.supplier' => ['nullable', 'string', 'max:255'],
            'products.*.unit' => ['required', 'string', 'max:50'],
            'products.*.purchase_price' => ['required', 'numeric', 'min:0'],
            'products.*.selling_price' => ['required', 'numeric', 'min:0'],
            'products.*.quantity' => ['required', 'integer', 'min:0'],
            'products.*.minimum_stock' => ['required', 'integer', 'min:0'],
            'products.*.warehouse_location' => ['nullable', 'string', 'max:255'],
            'products.*.description' => ['nullable', 'string'],
            'products.*.image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'products.*.status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $savedImages = [];

        try {
            DB::transaction(function () use ($r, &$savedImages) {

                foreach ($r->input('products', []) as $index => $item) {

                    $product = new Product();

                    $product->product_code = $item['product_code'];
                    $product->product_name = $item['product_name'];
                    $product->category = $item['category'] ?? null;
                    $product->sub_category = $item['sub_category'] ?? null;
                    // $product->supplier = $item['supplier'] ?? null;
                    $product->unit = $item['unit'];
                    $product->purchase_price = $item['purchase_price'];
                    $product->selling_price = $item['selling_price'];
                    $product->quantity = $item['quantity'];
                    $product->minimum_stock = $item['minimum_stock'];
                    $product->warehouse_location = $item['warehouse_location'] ?? null;
                    $product->description = $item['description'] ?? null;
                    $product->status = $item['status'];

                    if ($r->hasFile("products.$index.image")) {
                        $imagePath = $r->file("products.$index.image")
                            ->store('products', 'public');

                        $savedImages[] = $imagePath;
                        $product->image = $imagePath;
                    }

                    $product->save();
                }
            });
        } catch (\Throwable $e) {
            foreach ($savedImages as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            throw $e;
        }

        return redirect()->route('admin.suppliers.store')
            ->with('success', 'All products added successfully.');
    }
    public function updateproduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('products', 'product_code')->ignore($product->id),
            ],
            'product_name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'sub_category' => ['nullable', 'string', 'max:255'],
            // 'supplier' => ['nullable', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:50'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
            'warehouse_location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        foreach ([
            'product_code',
            'product_name',
            'category',
            'sub_category',
            // 'supplier',
            'unit',
            'purchase_price',
            'selling_price',
            'quantity',
            'minimum_stock',
            'warehouse_location',
            'description',
            'status',
        ] as $field) {
            $product->$field = $validated[$field] ?? null;
        }

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('products', 'public');

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $newImage;
        }

        $product->save();

        return redirect()
            ->route('admin.adminproducts')
            ->with('success', 'Product updated successfully.');
    }
    public function updateProductStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $product = Product::findOrFail($id);
        $product->status = $request->status;
        $product->save();

        return redirect()
            ->route('admin.adminproducts')
            ->with('success', 'Product status updated successfully.');
    }
    // Delete a product
    public function deleteproduct($id)
    {
        $product = Product::findOrFail($id);

        // Delete product image from storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete product from database
        $product->delete();

        return redirect()
            ->route('admin.adminproducts')
            ->with('success', 'Product deleted successfully.');
    }

    // public function productview()
    // {
    //     $data = Product::all();

    //     return view('/product', compact('data'));
    // }
    public function productview()
    {
        $data = Product::where('status', 'active')
            ->latest()
            ->get();

        return view('product', compact('data'));
    }
    // public function categories()
    // {
    //     $data = Product::whereNotNull('category')
    //                 ->where('category', '!=', '')
    //                 ->get();

    //     return view('admindashboard.category', compact('data'));
    // }
    
    public function categories(\Illuminate\Http\Request $request)
    {
        $search = trim($request->query('search', ''));

        $data = Product::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->select('category')
            ->selectRaw('COUNT(*) as total_products')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('category', 'like', '%' . $search . '%');
            })
            ->groupBy('category')
            ->orderBy('category')
            ->paginate(10)
            ->withQueryString();

        return view('admindashboard.category', compact('data', 'search'));
    }

    
    public function categoryProducts(\Illuminate\Http\Request $request, $category)
    {
        $search = trim($request->query('search', ''));

        $products = Product::query()
            ->where('category', $category)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('product_code', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admindashboard.category-products', compact('products', 'category'));
    }


    public function suppliers()
    {
        $suppliers = suppliers::all();

        return view('admindashboard.supplier', compact('suppliers'));
    }

    public function supplieradd(Request $r)
    {
        $validated = $r->validate([
            'supplier_code' => ['required', 'string', 'max:255', Rule::unique('suppliers', 'supplier_code')],
            'company_name' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'pincode' => ['nullable', 'string', 'max:10'],
            'gst_number' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $supplier = new suppliers();

        $supplier->supplier_code = $validated['supplier_code'];
        $supplier->company_name = $validated['company_name'];
        $supplier->contact_person = $validated['contact_person'] ?? null;
        $supplier->phone = $validated['phone'];
        $supplier->email = $validated['email'] ?? null;
        $supplier->address = $validated['address'] ?? null;
        $supplier->city = $validated['city'] ?? null;
        $supplier->state = $validated['state'] ?? null;
        $supplier->pincode = $validated['pincode'] ?? null;
        $supplier->gst_number = $validated['gst_number'] ?? null;
        $supplier->status = $validated['status'];

        $supplier->save();

        return redirect()->route('admin.purchases.create')
            ->with('success', 'Supplier added successfully.');
    }
   
public function suppliersview(Request $request)
{
    $search = trim($request->input('search', ''));

    $suppliers = suppliers::query()
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('supplier_code', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        })
        ->latest('id')
        ->get();

    return view('admindashboard.supplier', compact('suppliers', 'search'));
}

    public function editSupplier($id)
    {
        $supplier = suppliers::findOrFail($id);

        return view('admindashboard.edit-supplier', compact('supplier'));
    }
    public function updateSupplier(Request $request, $id)
    {
        $supplier = suppliers::findOrFail($id);

        $validated = $request->validate([
            'supplier_code' => [
                'required', 'string', 'max:255',
                Rule::unique('suppliers', 'supplier_code')->ignore($supplier->id),
            ],
            'company_name' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'gst_number' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'pincode' => ['nullable', 'string', 'max:10'],
            'address' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $supplier->update($validated);

        return redirect()->route('admin.suppliers')
            ->with('success', 'Supplier updated successfully.');
    }
    public function toggleSupplierStatus($id)
    {
        $supplier = suppliers::findOrFail($id);

        $supplier->status = $supplier->status === 'active'
            ? 'inactive'
            : 'active';

        $supplier->save();

        return redirect()->route('admin.suppliers')
            ->with('success', 'Supplier status updated successfully.');
    }
    public function deleteSupplier($id)
    {
        $supplier = suppliers::findOrFail($id);

        if (
            Schema::hasTable('purchases') &&
            Schema::hasColumn('purchases', 'supplier_id') &&
            DB::table('purchases')->where('supplier_id', $id)->exists()
        ) {
            return redirect()->route('admin.suppliers')
                ->withErrors([
                    'supplier_delete' =>
                        'This supplier cannot be deleted because purchase records exist.',
                ]);
        }

        $supplier->delete();

        return redirect()->route('admin.suppliers')
            ->with('success', 'Supplier deleted successfully.');
    }
    
    // Display all purchase invoices
   
public function Purchasesview()
{
    $Purchasesview = Purchase::with('supplier')
        ->latest('id')
        ->get();

    return view('admindashboard.purchases', compact('Purchasesview'));
}


    // Show new purchase invoice form
    public function createPurchase()
    {
        $suppliers = suppliers::where('status', 'active')
            ->orderBy('company_name')
            ->get();

        $products = Product::where('status', 'active')
            ->orderBy('product_name')
            ->get();

        return view('admindashboard.create-purchase', compact(
            'suppliers',
            'products'
        ));
    }

    // Save purchase invoice and its items
    
public function storePurchase(Request $request)
{
    $validated = $request->validate([
        'supplier_id' => [
            'required',
            'integer',
            'exists:suppliers,id',
        ],
        'bill_number' => [
            'required',
            'string',
            'max:255',
            'unique:purchases,bill_number',
        ],
        'purchase_date' => [
            'required',
            'date',
        ],
        'notes' => [
            'nullable',
            'string',
        ],
        'items' => [
            'required',
            'array',
            'min:1',
        ],
        'items.*.product_id' => [
            'required',
            'integer',
            'distinct',
            'exists:products,id',
        ],
        'items.*.quantity' => [
            'required',
            'integer',
            'min:1',
        ],
        'items.*.purchase_price' => [
            'required',
            'numeric',
            'min:0',
        ],
    ]);

    $supplier = suppliers::where('status', 'active')
        ->findOrFail($validated['supplier_id']);

    $subtotal = 0;

    foreach ($validated['items'] as $item) {
        $subtotal +=
            (int) $item['quantity'] *
            (float) $item['purchase_price'];
    }

    DB::transaction(function () use (
        $validated,
        $subtotal,
        $supplier
    ) {
        $purchase = Purchase::create([
            'supplier_id' => $supplier->id,
            'bill_number' => $validated['bill_number'],
            'purchase_date' => $validated['purchase_date'],
            'subtotal' => $subtotal,
            'grand_total' => $subtotal,
            'notes' => $validated['notes'] ?? null,
        ]);

        foreach ($validated['items'] as $item) {
            $product = Product::where('status', 'active')
                ->findOrFail($item['product_id']);

            $quantity = (int) $item['quantity'];
            $price = (float) $item['purchase_price'];
            $lineTotal = $quantity * $price;

            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'product_code' => $product->product_code,
                'unit' => $product->unit,
                'quantity' => $quantity,
                'purchase_price' => $price,
                'line_total' => $lineTotal,
            ]);
        }
    });

    return redirect()
        ->route('admin.purchases')
        ->with('success', 'Purchase invoice saved successfully.');
}


    // View a single purchase invoice
    public function showPurchase($id)
    {
        $purchase = Purchase::with(['supplier', 'items.product'])
            ->findOrFail($id);

        return view('admindashboard.view-purchase', compact('purchase'));
    }


    public function Stockview()
    {
        $Stockview = Product::all();

        return view('admindashboard.stock', compact('Stockview'));
    }

    // public function storestaff(Request $r)
    // {
    //     $data = new Staff();

    //     $data->name = $r->name;
    //     $data->email = $r->email;
    //     $data->password = Hash::make($r->password);
    //     $data->phone = $r->phone;

    //     if ($r->hasFile('image')) {
    //         $path = $r->file('image')->storeAs(
    //             '',
    //             $r->file('image')->getClientOriginalName(),
    //             'public'
    //         );

    //         $data->image = $path;
    //     }

    //     $data->save();

    //     return redirect('/staff');
    // }
    // public function staff()
    // {
    //     $staffs = Staff::all();

    //     return view('admindashboard.staff', compact('staffs'));
    // }
    // public function addstaff()
    // {
    //     return view('admindashboard.addstaff');
    // }
    
    public function staff(Request $request)
    {
        $search = trim($request->query('search', ''));

        $staffs = Staff::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admindashboard.staff', compact('staffs', 'search'));
    }

    public function addstaff()
    {
        return view('admindashboard.addstaff');
    }

    public function storestaff(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:staff,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:20'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('staff', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        Staff::create($validated);

        return redirect()->route('admin.staff')
            ->with('success', 'Staff added successfully.');
    }

    public function editstaff($id)
    {
        $staff = Staff::findOrFail($id);

        return view('admindashboard.editstaff', compact('staff'));
    }

    public function updatestaff(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('staff', 'email')->ignore($staff->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:20'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        unset($validated['password']);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('staff', 'public');

            if ($staff->image) {
                Storage::disk('public')->delete($staff->image);
            }

            $validated['image'] = $newImage;
        }

        $staff->update($validated);

        return redirect()->route('admin.staff')
            ->with('success', 'Staff updated successfully.');
    }

    public function deletestaff($id)
    {
        $staff = Staff::findOrFail($id);

        if ($staff->image) {
            Storage::disk('public')->delete($staff->image);
        }

        $staff->delete();

        return redirect()->route('admin.staff')
            ->with('success', 'Staff deleted successfully.');
    }
    
    // public function staffProducts()
    // {
    //     $products = Product::latest('id')->paginate(10);

    //     return view('staffdashboard.product', compact('products'));
    // }
    
   public function staffProducts(Request $request)
{
    $search = trim($request->input('search', ''));

    $products = Product::query()
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        })
        ->latest('id')
        ->get();

    return view('staffdashboard.product', compact('products', 'search'));
}


    public function editStaffProduct($id)
    {
        $product = Product::findOrFail($id);

        return view('staffdashboard.edit-product', compact('product'));
    }

    public function updateStaffProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'product_code')->ignore($product->id),
            ],
            'product_name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'sub_category' => ['nullable', 'string', 'max:255'],
            // 'supplier' => ['nullable', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:50'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
            'warehouse_location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $product->update($validated);

        return redirect()
            ->route('staffdashboard.product')
            ->with('success', 'Product updated successfully.');
    }

  public function staffSuppliers(\Illuminate\Http\Request $request)
{
    $search = $request->input('search');

    $suppliers = \App\Models\suppliers::query()
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%");
            });
        })
        ->orderByDesc('id')
        ->get();

    return view('staffdashboard.supplier', compact('suppliers', 'search'));
}
    
  public function staffStock(Request $request)
{
    $search = trim($request->input('search', ''));

    $products = Product::query()
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                  ->orWhere('product_code', 'like', "%{$search}%");
            });
        })
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();

    return view('staffdashboard.stock', compact('products', 'search'));
}
public function updateStaffStock(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'quantity' => ['required', 'integer', 'min:0'],
    ]);

    $product->quantity = $validated['quantity'];
    $product->save();

    return redirect()
        ->route('staffdashboard.stock')
        ->with('success', 'Stock quantity updated successfully.');
}

public function storeCustomerInterest(Request $request)
{
    $validated = $request->validate([
        'product_id' => ['required', 'integer', 'exists:products,id'],
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['required', 'string', 'max:10'],
        'address' => ['nullable', 'string', 'max:2000'],
        'message' => ['nullable', 'string', 'max:2000'],
    ]);

    $product = Product::where('status', 'active')
        ->where('quantity', '>', 0)
        ->find($validated['product_id']);

    if (!$product) {
        return redirect('/')
            ->withErrors(['product_id' => 'This product is currently out of stock.']);
    }

    Customer::create($validated);

    return redirect('/')
        ->with('success', 'Your enquiry has been submitted successfully.');
}



public function staffCustomers()
{
    $customers = \App\Models\Customer::with('product')
        ->latest()
        ->paginate(10);

    return view('staffdashboard.customer', compact('customers'));
}

public function staffSales()
{
    $sales = Sale::with(['customer', 'product'])
        ->latest()
        ->paginate(10);

    // Customer ni badhi enquiries mathi unique customers
    $customers = Customer::select('name', 'phone', 'email')
        ->selectRaw('MIN(id) as id')
        ->groupBy('name', 'phone', 'email')
        ->orderBy('name')
        ->get();

    // Badha active products with stock
    $products = Product::where('status', 'active')
        ->where('quantity', '>', 0)
        ->orderBy('product_name')
        ->get();

    return view('staffdashboard.sales', compact(
        'sales',
        'customers',
        'products'
    ));
}

public function storeSale(Request $request)
{
    $validated = $request->validate([
        'customer_id' => ['required', 'exists:customers,id'],
        'product_id' => ['required', 'exists:products,id'],
        'quantity' => ['required', 'integer', 'min:1'],
    ]);

    DB::transaction(function () use ($validated) {

        $customer = Customer::findOrFail($validated['customer_id']);

        $product = Product::where('id', $validated['product_id'])
            ->lockForUpdate()
            ->firstOrFail();

        if ($product->status !== 'active') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'product_id' => 'This product is inactive.',
            ]);
        }

        if ($product->quantity < $validated['quantity']) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'quantity' => 'Insufficient stock. Available stock: '
                    . $product->quantity,
            ]);
        }

        $unitPrice = $product->selling_price;
        $total = $unitPrice * $validated['quantity'];

        $sale = Sale::create([
            'invoice_number' => 'SAL-' . now()->format('YmdHis')
                . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'customer_phone' => $customer->phone,
            'quantity' => $validated['quantity'],
            'unit_price' => $unitPrice,
            'total_amount' => $total,
            'status' => 'Completed',
        ]);

        $product->decrement('quantity', $validated['quantity']);
    });

    return redirect()
        ->route('staffdashboard.sales')
        ->with('success', 'Sale completed and stock updated successfully.');
}
public function getCustomerEnquiryProducts($customerId)
{
    $customer = Customer::findOrFail($customerId);

    $products = Product::whereIn(
        'id',
        Customer::where('name', $customer->name)
            ->where('phone', $customer->phone)
            ->where('email', $customer->email)
            ->pluck('product_id')
    )
    ->where('status', 'active')
    ->where('quantity', '>', 0)
    ->orderBy('product_name')
    ->get([
        'id',
        'product_name',
        'selling_price',
        'quantity'
    ]);

    return response()->json($products);
}


public function adminSales()
{
    $sales = Sale::with(['customer', 'product'])
        ->latest()
        ->paginate(10);

    return view('admindashboard.sales', compact('sales'));
}
public function adminInternalCustomers()
{
    $customers = Customer::latest()->paginate(10);

    return view('admindashboard.internalCustomer', compact('customers'));
}

    public function login(Request $r)
{
    $r->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // ADMIN LOGIN
    $adminemail = $r->email;
    $adminpassword = $r->password;

    if ($adminemail == "wms@gmail.com" && $adminpassword == "wms@123") {

        $r->session()->regenerate();

        session([
            'email' => $r->email,
            'login' => true,
            'role' => 'admin'
        ]);

        return redirect('/ad');
    }

    // STAFF LOGIN
    $user = Staff::where('email', $r->email)->first();

    if (!$user) {
        return back()
            ->withErrors(['email' => 'Email not found'])
            ->withInput($r->only('email'));
    }

    if (!Hash::check($r->password, $user->password)) {
        return back()
            ->withErrors(['password' => 'Invalid password'])
            ->withInput($r->only('email'));
    }

    // STAFF LOGIN SUCCESS
    $r->session()->regenerate();

    session([
        'staff_id' => $user->id,
        'staff_name' => $user->name,
        'email' => $user->email,
        'login' => true,
        'role' => 'staff'
    ]);

    return redirect('/sd');
}
public function staffDashboard()
{
    $totalProducts = Product::count();

    $totalCategories = Product::whereNotNull('category')
        ->where('category', '!=', '')
        ->distinct()
        ->count('category');

    $totalSuppliers = suppliers::count();

    $totalCustomers = Customer::select('name', 'email', 'phone')
        ->distinct()
        ->get()
        ->count();

    $currentStock = Product::sum('quantity');

    $lowStock = Product::whereColumn(
        'quantity',
        '<=',
        'minimum_stock'
    )->count();

    $stockIn = PurchaseItem::sum('quantity');

    $stockOut = Sale::sum('quantity');

    $recentPurchases = Purchase::with('supplier')
        ->latest('id')
        ->take(5)
        ->get();

    return view('staffdashboard.staffdashboard', compact(
        'totalProducts',
        'totalCategories',
        'totalSuppliers',
        'totalCustomers',
        'currentStock',
        'lowStock',
        'stockIn',
        'stockOut',
        'recentPurchases'
    ));
}
public function staffProfile()
{
    if (session('role') !== 'staff' || !session('staff_id')) {
        return redirect()->route('login');
    }

    $staff = Staff::findOrFail(session('staff_id'));

    return view('staffdashboard.profile', compact('staff'));
}

public function dashboard()
{
    $totalStaff = Staff::count();

    $totalProducts = Product::count();

    $totalCategories = Product::whereNotNull('category')
        ->where('category', '!=', '')
        ->distinct()
        ->count('category');

    $totalSuppliers = suppliers::count();

    $totalCustomers = Customer::select('name', 'email', 'phone')
        ->distinct()
        ->get()
        ->count();

    $totalPurchases = Purchase::count();

    $totalSales = Sale::count();

    $currentStock = Product::sum('quantity');

    $purchaseValue = Purchase::sum('grand_total');

    $salesValue = Sale::sum('total_amount');

    $outOfStock = Product::where('quantity', 0)->count();

    $recentPurchases = Purchase::with('supplier')
        ->latest('id')
        ->take(5)
        ->get();

    $recentSales = Sale::with(['customer', 'product'])
        ->latest('id')
        ->take(5)
        ->get();

    $lowStockProducts = Product::whereColumn(
        'quantity',
        '<=',
        'minimum_stock'
    )
        ->orderBy('quantity')
        ->take(10)
        ->get();

    return view('admindashboard.admindashboard', compact(
        'totalStaff',
        'totalProducts',
        'totalCategories',
        'totalSuppliers',
        'totalCustomers',
        'totalPurchases',
        'totalSales',
        'currentStock',
        'purchaseValue',
        'salesValue',
        'outOfStock',
        'recentPurchases',
        'recentSales',
        'lowStockProducts'
    ));
}
public function create()
{
    return view('students.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'student_name' => 'required|string|max:100',
        'roll_number' => 'required|string|max:20|unique:students,roll_number',
        'email' => 'required|email|max:100|unique:students,email',
        'phone' => 'nullable|string|max:15',
        'gender' => 'nullable|string|max:10',
        'date_of_birth' => 'nullable|date',
        'course' => 'required|string|max:50',
        'semester' => 'required|integer|min:1',
    ]);

    DB::table('students')->insert([
        ...$validated,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()
        ->route('students.create')
        ->with('success', 'Student data saved successfully!');
}





}
