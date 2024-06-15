<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\TextUI\Help;

class SliderController extends Controller
{
    const PATH_UPLOAD = 'sliders';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Slider Manager';

        $data = Slider::query()->latest()->paginate(10);

        $trash = Slider::query()->onlyTrashed()->exists();

        return view('admin.sliders.index', compact('title', 'data', 'trash'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Slider';
        return view('admin.sliders.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');

        $data['status'] ??= 0;

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        if ($data) {

            Slider::query()->create($data);
            toastr()->success('Thao tác thành công!', 'Success', ['timeout' => 2000]);

            return redirect()->route('admin.sliders.index');
        }

        toastr()->error('Có lỗi xảy ra, vui bạn thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Slider details';

        $silder  = Slider::query()->findOrFail($id);

        return view('admin.sliders.show', compact('title', 'silder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Update Slider';

        $slider = Slider::query()->findOrFail($id);

        return view('admin.sliders.edit', compact('title', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::query()->findOrFail($id);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));

            if ($slider->image && Storage::exists($slider->image)) {
                Storage::delete($slider->image);
            }
        } else {
            $data['image'] = $slider->image;
        }

        if ($data) {
            $slider->update($data);

            toastr()->success('Thao tác thành công!', 'Success', ['timeout' => 2000]);
            return redirect()->back();
        }
        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->back();
    }

    public function trash()
    {
        $title = 'Trashed Slider';

        $trash = Slider::query()->onlyTrashed()->latest()->paginate(10);

        return view('admin.sliders.trash', compact('title', 'trash'));
    }

    public function delete(string $id)
    {
        $slider = Slider::query()->findOrFail($id);

        DB::transaction(function () use ($slider) {
            $slider->status = 0;

            $slider->save();
            $slider->delete();
        });

        toastr()->success('Thao tác thành công!', 'Success', ['timeout' => 2000]);

        return redirect()->back();
    }

    public function restore(string $id)
    {
        $slider = Slider::query()->withTrashed()->findOrFail($id);

        if ($slider->trashed()) {
            $slider->restore();
            toastr()->success('Khôi phục dữ liệu thành công', 'Success', ['timeout' => 2000]);

            return redirect()->route('admin.sliders.index');
        }

        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->route('admin.sliders.trash');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::query()->withTrashed()->findOrFail($id);

        if ($slider->trashed()) {

            $slider->forceDelete();

            if ($slider->image && Storage::exists($slider->image)) {
                Storage::delete($slider->image);
            }

            toastr()->success('Thao tác thành công!!', 'Success', ['timeout' => 2000]);
            return redirect()->route('admin.sliders.index');
        }

        toastr()->error('Có lỗi xảy ra, vui lòng thử lại sau!', 'Error', ['timeout' => 2000]);
        return redirect()->back();
    }
}
