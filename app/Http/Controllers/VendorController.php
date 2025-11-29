<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Products;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::all();
        return view('admin.admin_vehicle_types', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vendor = vendor::create([
            'ten_dongxe' => $request->name,
            'mota_dongxe' => $request->description, 
       ]);
       return redirect()->back()->with('success', 'Thêm dòng xe thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $vendor = vendor::find($id);
        if (!$vendor) {
            return response()->json(['error' => 'Không tìm thấy dòng xe!'], 404);
        }
        // Cập nhật dữ liệu
        $vendor->update([
            'ten_dongxe' => $request->name ?? $vendor->ten_dongxe,
            'mota_dongxe' => $request->description ?? $vendor->mota_dongxe,   
        ]);

        return redirect()->back()->with('success', 'Cập nhật dòng xe thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
         $vendor = vendor::find($id);
        $products = Products::where('id_dongxe', $id)->count();
        if ($products > 0) {
            return redirect()->back()->with('error', 'Không thể xóa dòng xe vì còn sản phẩm liên quan!');
        }
        if (!$vendor) {
            return redirect()->back()->with('error', 'Dòng xe không tồn tại!');
        }
        $vendor->delete();
        return redirect()->back()->with('success', 'Xoá dòng xe thành công!');
       
    }
}
