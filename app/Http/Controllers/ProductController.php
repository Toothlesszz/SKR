<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $products = products::all();
        return view('admin.admin_products')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::all();

        return view('admin.create_product')->with(compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
    
   // Xử lý dữ liệu từ request
    $features = $request->input('highlight_points', []); // Mảng điểm nổi bật
    $productImages = [];
    $productImagePaths = [];
    if ($request->hasFile('product_images')) {
        foreach ($request->file('product_images') as $file) {
            $filename = $file->hashName();
            $path = $file->storeAs('uploads/products', $filename, 'public');
            $productImagePaths[] = $path;
        }
    }

    $techImagePaths = [];
    if ($request->hasFile('technical_spec_images')) {
        foreach ($request->file('technical_spec_images') as $file) {
            $filename = $file->hashName();
            $path = $file->storeAs('uploads/tech_specs', $filename, 'public');
            $techImagePaths[] = $path;
        }
    }
            
        // Xử lý "mô tả chi tiết" (bao gồm text và ảnh)
        $detailedDescription = $request->input('detailed_description', '');
        if ($request->hasFile('description_images')) {
            foreach ($request->file('description_images') as $image) {
                $fileName = $image->getClientOriginalName();
                $path = $image->storeAs('uploads/descriptions', $fileName, 'public'); // Lưu ảnh vào thư mục 'uploads/descriptions'
                $detailedDescription .= '<img src="' . asset('storage/' . $path) . '">';
            }
        }
        $highlightPoints = [];
    foreach ($request->all() as $key => $value) {
        if (strpos($key, 'highlight_point') === 0) {
            $highlightPoints[] = $value;
        }
    }
    $html = $request->input('detailed_description');

    // Load HTML vào DOMDocument
    $dom = new \DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    libxml_clear_errors();

    $images = $dom->getElementsByTagName('img');

    foreach ($images as $img) {
        $src = $img->getAttribute('src');

        // Nếu là base64 → convert
        if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {

            $imageData = substr($src, strpos($src, ',') + 1);
            $imageData = base64_decode($imageData);

            $ext = strtolower($type[1]); // png, jpg, etc.
            $filename = uniqid() . "." . $ext;

            // Lưu file vào storage
            Storage::disk('public')->put("descriptions/$filename", $imageData);

            // Thay link base64 bằng link file thực
            $img->setAttribute("src", asset("storage/descriptions/$filename"));
        }
    }

    // Xuất HTML đã replace
    $cleanHtml = $dom->saveHTML();
    // Lấy giá trị hiển thị sản phẩm
    $showProduct = $request->boolean('show_product');
    // Tạo đối tượng sản phẩm mới
    $product = new Products();

    $product->ten_sp = $request->input('name');
    $product->mota = $request->input('mota');
    $product->slug = $request->input('slug');
    $product->hinhanh = json_encode($productImagePaths); 
    $product->chitiet = json_encode($highlightPoints);
    $product->id_dongxe = $request->input('category'); 
    $product->hienthi = $showProduct; 
    $product->thongso = json_encode($techImagePaths); 
    $product->mota_chitiet = $cleanHtml; 
    $product->seo_title = $request->input('seo_title');
    $product->seo_description = $request->input('seo_description');
    // Lưu sản phẩm vào database
    $product->save();

    return redirect()->back()->with('success', 'Tạo sản phẩm thành công!');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getUpdate(Request $request, $id)
    {
        
        $product = products::find($id);
        $vendors = Vendor::all();
        $vendorname = Vendor::where('id', $product->id_dongxe)->first();
        $otherVendors = Vendor::where('id', '!=', $product->id_dongxe)->get();
        if (!$product) {
            return response()->json(['error' => 'Không tìm thấy sản phẩm!'], 404);
        }
        return view('admin.product_management')->with(compact('product', 'vendors', 'vendorname', 'otherVendors'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $product = Products::findOrFail($id);
    // --- 1. Xử lý highlight points ---
    $highlightPoints = [];
    $raw = $request->input('highlight_points', '[]');
    $decoded = json_decode($raw, true);
    if (is_array($decoded)) {
        $highlightPoints = array_values(array_filter(array_map('trim', $decoded)));
    } else {
        // fallback: older inputs (if any) - collect any keys like highlight_point_... or highlight_point[]
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'highlight_point') === 0) {
                if (is_array($value)) {
                    foreach ($value as $v) $highlightPoints[] = trim($v);
                } else {
                    $highlightPoints[] = trim($value);
                }
            }
        }
        // remove empty
        $highlightPoints = array_values(array_filter($highlightPoints));
    }
    // --- 2. PRODUCT IMAGES (unified name: product_images[]) ---
    // DB stored old images
    $oldProductImages = json_decode($product->hinhanh, true) ?? [];

    // Images marked deleted by client
    $deletedProduct = $request->input('deleted_product_images', []);
    if (!empty($deletedProduct) && is_array($deletedProduct)) {
        foreach ($deletedProduct as $delPath) {
            if ($delPath && Storage::disk('public')->exists($delPath)) {
                Storage::disk('public')->delete($delPath);
            }
        }
    }

    // Start from what's submitted as existing images (hidden inputs named product_images[])
    $submittedExistingProductImages = $request->input('product_images', []);
    if (!is_array($submittedExistingProductImages)) {
        $submittedExistingProductImages = $submittedExistingProductImages ? [$submittedExistingProductImages] : [];
    }

    // Ensure deleted ones are removed from submitted existing
    if (!empty($deletedProduct)) {
        $submittedExistingProductImages = array_values(array_diff($submittedExistingProductImages, $deletedProduct));
    }

    // Now handle uploaded files (also named product_images[])
    $finalProductImages = $submittedExistingProductImages;
    $uploadedProductFiles = $request->file('product_images', []);
    if ($uploadedProductFiles) {
        // normalize to array
        if (!is_array($uploadedProductFiles)) {
            $uploadedProductFiles = [$uploadedProductFiles];
        }
        foreach ($uploadedProductFiles as $file) {
            if ($file && $file->isValid()) {
                $filename = $file->hashName();
                $path = $file->storeAs('uploads/products', $filename, 'public'); // returns path like uploads/products/xxx.jpg
                $finalProductImages[] = $path;
            }
        }
    }

    // Remove duplicates and reindex
    $finalProductImages = array_values(array_unique($finalProductImages));

    // --- 3. TECHNICAL / SPEC IMAGES (unified name: technical_images[]) ---
    $oldTechImages = json_decode($product->thongso, true) ?? [];

    $deletedTech = $request->input('deleted_technical_images', []);
    if (!empty($deletedTech) && is_array($deletedTech)) {
        foreach ($deletedTech as $delPath) {
            if ($delPath && Storage::disk('public')->exists($delPath)) {
                Storage::disk('public')->delete($delPath);
            }
        }
    }

    $submittedExistingTechImages = $request->input('technical_images', []);
    if (!is_array($submittedExistingTechImages)) {
        $submittedExistingTechImages = $submittedExistingTechImages ? [$submittedExistingTechImages] : [];
    }
    if (!empty($deletedTech)) {
        $submittedExistingTechImages = array_values(array_diff($submittedExistingTechImages, $deletedTech));
    }

    $finalTechImages = $submittedExistingTechImages;
    $uploadedTechFiles = $request->file('technical_images', []);
    if ($uploadedTechFiles) {
        if (!is_array($uploadedTechFiles)) {
            $uploadedTechFiles = [$uploadedTechFiles];
        }
        foreach ($uploadedTechFiles as $file) {
            if ($file && $file->isValid()) {
                $filename = $file->hashName();
                $path = $file->storeAs('uploads/tech_specs', $filename, 'public');
                $finalTechImages[] = $path;
            }
        }
    }
    $finalTechImages = array_values(array_unique($finalTechImages));

    // --- 4. Xử lý image trong WYSIWYG (base64) ---
    $html = $request->input('detailed_description', '');
    if ($html) {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $imageData = substr($src, strpos($src, ',') + 1);
                $imageData = base64_decode($imageData);

                $ext = strtolower($type[1]);
                $filename = uniqid() . '.' . $ext;

                Storage::disk('public')->put("descriptions/$filename", $imageData);

                $img->setAttribute("src", asset("storage/descriptions/$filename"));
            }
        }

        $cleanHtml = $dom->saveHTML();
    } else {
        $cleanHtml = '';
    }

    // --- 5. Cập nhật dữ liệu sản phẩm ---
    $product->ten_sp = $request->input('name');
    $product->slug = $request->input('slug');
    $product->mota = $request->input('mota');
    $product->hinhanh = json_encode($finalProductImages);
    $product->chitiet = json_encode($highlightPoints);
    $product->id_dongxe = $request->input('category');
    $product->hienthi = $request->boolean('show_product');
    $product->thongso = json_encode($finalTechImages);
    $product->mota_chitiet = $cleanHtml;
    $product->seo_title = $request->input('seo_title');
    $product->seo_description = $request->input('seo_description');

    $product->save();

    return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
          $product = Products::findOrFail($id);

    DB::beginTransaction();
    try {
        // helper to convert img src or stored path to storage relative path
        $toStoragePath = function ($src) {
            if (!$src) return null;
            // full URL or absolute path containing /storage/
            $p = $src;
            // if URL, extract path component
            if (filter_var($p, FILTER_VALIDATE_URL)) {
                $u = parse_url($p, PHP_URL_PATH) ?: $p;
            } else {
                $u = $p;
            }
            // find "/storage/" segment and take what's after it
            $pos = mb_strpos($u, '/storage/');
            if ($pos !== false) {
                return ltrim(mb_substr($u, $pos + strlen('/storage/')), '/');
            }
            // if already a storage-relative path (uploads/...)
            if (preg_match('#^(uploads/|descriptions/|images/)#', $u)) {
                return $u;
            }
            // if a full filesystem path (rare), try to get basename under uploads
            $basename = basename($u);
            if ($basename) {
                // try common folders
                foreach (['uploads/products/', 'uploads/tech_specs/', 'descriptions/'] as $prefix) {
                    $candidate = $prefix . $basename;
                    if (Storage::disk('public')->exists($candidate)) return $candidate;
                }
            }
            return null;
        };

        // collect product image arrays (hinhanh, thongso)
        $imgLists = [];
        $hinhanh = json_decode($product->hinhanh, true);
        if (is_array($hinhanh)) $imgLists = array_merge($imgLists, $hinhanh);
        $thongso = json_decode($product->thongso, true);
        if (is_array($thongso)) $imgLists = array_merge($imgLists, $thongso);

        // delete each image path if exists
        foreach ($imgLists as $item) {
            $rel = $toStoragePath($item);
            if ($rel && Storage::disk('public')->exists($rel)) {
                Storage::disk('public')->delete($rel);
            }
        }

        // also remove images embedded in detailed description HTML
        $html = $product->mota_chitiet ?? '';
        if ($html) {
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
            libxml_clear_errors();
            $imgs = $dom->getElementsByTagName('img');
            foreach ($imgs as $img) {
                $src = $img->getAttribute('src');
                $rel = $toStoragePath($src);
                if ($rel && Storage::disk('public')->exists($rel)) {
                    Storage::disk('public')->delete($rel);
                }
            }
        }

        // finally delete DB record
        $product->delete();

        DB::commit();
        return redirect()->back()->with('success', 'Xóa sản phẩm thành công.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Product delete error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Lỗi khi xóa sản phẩm.');
        }
    }
}
