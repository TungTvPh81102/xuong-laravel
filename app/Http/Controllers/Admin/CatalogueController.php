<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Catelogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CatalogueController extends Controller
{
    const PATH_UPLOAD = 'catalogues';
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $title = 'Catalogue Management';

        $data = Catalogue::query()->where('deleted_at', null)->latest()->paginate(10);

        $trash = Catalogue::query()->onlyTrashed()->exists();

        return view('admin.catalogues.index', compact('title', 'data', 'trash'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Catalogue';

        return view('admin.catalogues.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (isset($data['name'])) {
            $slug = Str::slug($data['name'], '-');
            $data['slug'] = $slug;
        }

        if ($data) {
            Catalogue::query()->create($data);
            toastr()->success('Thao tác thành công!', 'Success', ['timeout' => 2000]);
            return redirect()->route('admin.catalogues.index');
        }


        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->back()->with('success', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Chi tiết danh mục';

        $catalogue = Catalogue::query()->findOrFail($id);

        return view('admin.catalogues.show', compact('title', 'catalogue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Cập nhật danh mục';

        $catalogue = Catalogue::query()->findOrFail($id);

        return view('admin.catalogues.edit', compact('title', 'catalogue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $catalogue = Catalogue::query()->findOrFail($id);

        $data = $request->all();

        if (isset($data['name'])) {
            $slug = Str::slug($data['name'], '-');
            $data['slug'] = $slug;
        }

        if ($data) {

            $catalogue->update($data);
            toastr()->success('Thao tác thành công!', 'Success', ['timeout' => 2000]);

            return redirect()->back();
        }

        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->back();
    }

    public function delete(string $id)
    {
        $catalogue =  Catalogue::query()->findOrFail($id);

        DB::transaction(function () use ($catalogue) {
            $catalogue->status = 'draft';

            $catalogue->save();
            $catalogue->delete();
        });

        toastr()->success('Thao tác thành công!!', 'Success', ['timeout' => 2000]);

        return redirect()->back();
    }

    public function trash()
    {
        $title = 'Danh mục đẫ xóa gần đây';

        $catalogue = Catalogue::query()->onlyTrashed()->latest()->paginate(10);

        return view('admin.catalogues.trash', compact('title', 'catalogue'));
    }

    public function restore(string $id)
    {
        $catalogue = Catalogue::withTrashed()->findOrFail($id);

        if ($catalogue->trashed()) {

            $catalogue->restore();
            toastr()->success('Khôi phục dữ liệu thành công!', 'Success', ['timeout' => 2000]);

            return redirect()->route('admin.catalogues.index');
        }

        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->route('admin.catalogues.trash');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catalogue = Catalogue::query()->withTrashed()->findOrFail($id);

        if ($catalogue->trashed()) {

            $catalogue->forceDelete();

            toastr()->success('Thao tác thành công!!', 'Success', ['timeout' => 2000]);
            return redirect()->route('admin.catalogues.index');
        }

        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->back();
    }
}
