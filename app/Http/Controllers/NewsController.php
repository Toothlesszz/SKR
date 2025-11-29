<?php

namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(request()->has('search') || request()->has('status')) {
        $query = News::query();

        // Tìm theo tiêu đề hoặc nội dung
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('tieude', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Lọc theo trạng thái
        if ($request->status) {
            $query->where('hienthi', $request->status);
        }

        // Lấy dữ liệu sau khi lọc
        $newsList = $query->orderBy('id', 'desc')->get();
        
        return view('admin.news_management', compact('newsList'));
        }
        else {
            $newsList = news::all();
            return view('admin.news_management', compact('newsList'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.create_news');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $tags = $request->input('tags', []); // Mảng điểm nổi bật
       
        if ($request->hasFile('cover_image')) {
            
                $file = $request->file('cover_image');
                $filename = $file->hashName();
                $path = $file->storeAs('uploads/news', $filename, 'public');
                $coverImagePaths = $path;
            
        }
        $detailedDescription = $request->input('detailed_description', '');
        if ($request->hasFile('description_images')) {
            foreach ($request->file('description_images') as $image) {
                $fileName = $image->getClientOriginalName();
                $path = $image->storeAs('uploads/news', $fileName, 'public'); // Lưu ảnh vào thư mục 'uploads/news'
                $detailedDescription .= '<img src="' . asset('storage/' . $path) . '">';
            }
        }
        $tags = [];
    foreach ($request->all() as $key => $value) {
        if (strpos($key, 'tag') === 0) {
            $tags[] = $value;
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
            Storage::disk('public')->put("news/$filename", $imageData);

            // Thay link base64 bằng link file thực
            $img->setAttribute("src", asset("storage/news/$filename"));
        }
    }

    // Xuất HTML đã replace
    $cleanHtml = $dom->saveHTML();
    // Lấy giá trị hiển thị sản phẩm
    $showNews = $request->boolean('show_news');
        $news = new News();
        $news->slug_tintuc = $request->slug_tintuc;
        $news->tieude = $request->tieude;
        $news->tag = json_encode($tags);
        $news->anhbia = $coverImagePaths;
        $news->noidung = $cleanHtml;
        $news->hienthi = $showNews;
        $news->seo_title = $request->seo_title;
        $news->seo_description = $request->seo_description;
        $news->save();
       return redirect()->back()->with('success', 'Thêm tin tức thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUpdate($id)
    {
        $news = news::find($id);
        if (!$news) {
            return redirect()->back()->with('error', 'Không tìm thấy tin tức!');
        }
        return view('admin.update_news', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
          
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
           $news = News::findOrFail($id);
  
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
    $oldNewsImages = $news->anhbia;

    // Images marked deleted by client
    $deletedImage = $request->input('deleted_image');
            if ($deletedImage && Storage::disk('public')->exists($deletedImage)) {
                Storage::disk('public')->delete($deletedImage);
    }

    // Start from what's submitted as existing images 
    $submittedExistingNewsImages = $request->input('cover_image_file');

    // Ensure deleted ones are removed from submitted existing
    if (!empty($deletedImage)) {
        $submittedExistingNewsImages =  $deletedImage;
    }

    // Now handle uploaded files (also named cover_images[])
    $finalNewsImages = $submittedExistingNewsImages;
    $uploadedNewsFiles = $request->file('cover_image_file');
    if ($uploadedNewsFiles) {
        // normalize to array
            if ($uploadedNewsFiles && $uploadedNewsFiles->isValid()) {
                $filename = $uploadedNewsFiles->hashName();
                $path = $uploadedNewsFiles->storeAs('uploads/news', $filename, 'public'); // returns path like uploads/news/xxx.jpg
                $finalNewsImages = $path;
            }     
    }
    if(!$finalNewsImages){
        $finalNewsImages = $oldNewsImages;
    }

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
    $news->slug_tintuc = $request->input('slug');
    $news->tieude = $request->input('title');
    $news->tag = json_encode($highlightPoints);
    $news->anhbia = $finalNewsImages;
    $news->hienthi = $request->boolean('show_news');
    $news->noidung = $cleanHtml;
    $news->seo_title = $request->input('seo_title');
    $news->seo_description = $request->input('seo_description');
    $news->save();

    return redirect()->back()->with('success', 'Cập nhật tin tức thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
         $news = News::findOrFail($id);

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


        $hinhanh =$news->anhbia;
        // delete each image path if exists

            $rel = $toStoragePath($hinhanh);
            if ($rel && Storage::disk('public')->exists($rel)) {
                Storage::disk('public')->delete($rel);
            }
        

        // also remove images embedded in detailed description HTML
        $html = $news->noidung ?? '';
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
        $news->delete();

        DB::commit();
        return redirect()->back()->with('success', 'Xóa tin tức thành công.');
        } 
        catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('News delete error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Lỗi khi xóa tin tức.');
        }
    }
    
}
