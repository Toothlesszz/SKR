<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Information;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.admin');
    }

    public function login(Request $request)
    {
          $this->validate($request, [
          'username'=>'required',
          'password'=>'required|min:6|max:32',
      ],
      [
          'username.required'=>'Vui lòng nhập email của bạn!',
          'password.required'=>'Vui lòng nhập mật khẩu của bạn!',
          'password.min'=>'Mật khẩu có ít nhất 6 ký tự!',
          'password.max'=>'Mật khẩu không vượt quá 32 ký tự!',
      ]);
      $credentials = $request->only('username', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        
        return redirect()->intended('/admin/dashboard');
    }
    
        else{
            return back()->withErrors(['username' => 'Sai email hoặc mật khẩu']);
        }
        
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInformation()
    {
        $information = Information::first();
         // Lấy dữ liệu thô từ DB
    $raw = $information->banner_pics;

    // Loại bỏ dấu " thừa
    $clean = trim($raw, '"');

    // Bỏ escape \\
    $clean = stripslashes($clean);

    // Decode JSON
    $banner = json_decode($clean, true);
        return view('admin.dashboard', compact('information', 'banner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBanner()
    {
        $information = Information::first();
            $raw = $information->banner_pics;
            $clean = trim($raw, '"');
            $clean = stripslashes($clean);
            $banner = json_decode($clean, true);
        return view('admin.banner_management', compact('information', 'banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInformation(Request $request)
    {
        $id = $request->input('id');
        $information = Information::find($id);
        $information->address1 = $request->input('address1');
        $information->address2 = $request->input('address2');
        $information->phone1 = $request->input('phone1');
        $information->phone2 = $request->input('phone2');
        $information->zalo = $request->input('zalo');
        $information->facebook = $request->input('facebook');
        $information->instagram = $request->input('instagram');
        $information->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBanner(Request $request)
    {
        $id = $request->input('information_id');
        $information = Information::find($id);
        // --- 2. PRODUCT IMAGES (unified name: banner_images[]) ---
    // DB stored old images
    $oldProductImages = json_decode($information->banner_pics, true) ?? [];

    // Images marked deleted by client
    $deletedProduct = $request->input('deleted_banner_images', []);
    if (!empty($deletedProduct) && is_array($deletedProduct)) {
        foreach ($deletedProduct as $delPath) {
            if ($delPath && Storage::disk('public')->exists($delPath)) {
                Storage::disk('public')->delete($delPath);
            }
        }
    }

    // Start from what's submitted as existing images (hidden inputs named banner_images[])
    $submittedExistingProductImages = $request->input('banner_images', []);
    if (!is_array($submittedExistingProductImages)) {
        $submittedExistingProductImages = $submittedExistingProductImages ? [$submittedExistingProductImages] : [];
    }

    // Ensure deleted ones are removed from submitted existing
    if (!empty($deletedProduct)) {
        $submittedExistingProductImages = array_values(array_diff($submittedExistingProductImages, $deletedProduct));
    }

    // Now handle uploaded files (also named banner_images[])
    $finalProductImages = $submittedExistingProductImages;
    $uploadedProductFiles = $request->file('banner_images', []);
    if ($uploadedProductFiles) {
        // normalize to array
        if (!is_array($uploadedProductFiles)) {
            $uploadedProductFiles = [$uploadedProductFiles];
        }
        foreach ($uploadedProductFiles as $file) {
            if ($file && $file->isValid()) {
                $filename = $file->hashName();
                $path = $file->storeAs('uploads/banners', $filename, 'public'); // returns path like uploads/banners/xxx.jpg
                $finalProductImages[] = $path;
            }
        }
    }

    // Remove duplicates and reindex
    $finalProductImages = array_values(array_unique($finalProductImages));
    $information->banner_pics = json_encode($finalProductImages);
        $information->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
