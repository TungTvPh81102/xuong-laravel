<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    const PATH_UPLOAD = 'brands';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Brand Management';

        $data = Brand::query()->where('deleted_at', null)->latest()->paginate(10);

        $trash = Brand::query()->onlyTrashed()->exists();

        return view('admin.brands.index', compact('title', 'data', 'trash'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Brand';

        return view('admin.brands.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('cover');

        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }

        if ($data) {
            Brand::query()->create($data);
            toastr()->success('Thao tác thành công!', 'Success', ['timeout' => 2000]);
            return redirect()->route('admin.brands.index');
        }

        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $title = 'Brand Details';

        $brand = Brand::query()->findOrFail($id);

        return view('admin.brands.show', compact('title', 'brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Brand';

        $brand = Brand::query()->findOrFail($id);

        return view('admin.brands.edit', compact('title', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::query()->findOrFail($id);

        $data = $request->except('cover');

        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));

            if ($brand->cover && Storage::exists($brand->cover)) {
                Storage::delete($brand->cover);
            }
        } else {
            $data['cover'] = $brand->cover;
        }

        if ($data) {

            $brand->update($data);
            toastr()->success('Thao tác thành công!', 'Success', ['timeout' => 2000]);

            return redirect()->back();
        }

        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->back();
    }

    public function trash()
    {
        $title = 'Brand Trash';

        $data = Brand::query()->onlyTrashed()->latest()->paginate(10);

        return view('admin.brands.trash', compact('title', 'data'));
    }

    public function delete(string $id)
    {
        $brand = Brand::query()->findOrFail($id);

        DB::transaction(function () use ($brand) {
            $brand->status = 'draft';

            $brand->save();
            $brand->delete();
        });

        toastr()->success('Thao tác thành công!!', 'Success', ['timeout' => 2000]);

        return redirect()->back();
    }


    public function restore(string $id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);

        if ($brand->trashed()) {

            $brand->restore();
            toastr()->success('Khôi phục dữ liệu thành công!', 'Success', ['timeout' => 2000]);

            return redirect()->route('admin.brands.index');
        }

        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->route('admin.brands.trash');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::query()->withTrashed()->findOrFail($id);

        if ($brand->trashed()) {

            $brand->forceDelete();

            if ($brand->cover && Storage::exists($brand->cover)) {
                Storage::delete($brand->cover);
            }

            toastr()->success('Thao tác thành công!!', 'Success', ['timeout' => 2000]);
            return redirect()->route('admin.brands.index');
        }

        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->back();
    }
}
