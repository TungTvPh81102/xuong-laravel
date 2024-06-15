<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Catalogue;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PATH_UPLOAD_PRODUCT = 'products';
    const PATH_UPLOAD_GALLERY = 'gallerys';

    const PATH_UPLOAD_VARIANT = 'variants';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Product Management';

        $products = Product::query()->with('catalogue', 'brand', 'tags')->where('deleted_at', null)->latest('id')->get();

        $trash  = Product::query()->onlyTrashed()->exists();

        return view('admin.products.index', compact('title', 'products', 'trash'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Product';

        $catalogue = Catalogue::query()->latest()->get();

        $brand = Brand::query()->latest()->get();

        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $colors = ProductColor::query()->pluck('name', 'id')->all();

        $tags = Tag::query()->pluck('name', 'id')->all();

        return view('admin.products.create', compact('title', 'catalogue', 'brand', 'sizes', 'colors', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $dataProduct = $request->except([
            'product_variants',
            'tags',
            'product_galleries'
        ]);

        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];
        if ($dataProduct['image_thumbnail']) {
            $dataProduct['image_thumbnail'] = Storage::put(self::PATH_UPLOAD_PRODUCT, $dataProduct['image_thumbnail']);
        }

        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $value) {
            $tmp = explode('-', $key);
            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $value['quantity'],
                'image' => $value['image'] ?? null
            ];
        }

        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries ?: [];

        try {
            DB::beginTransaction();

            //** @var Product $product */
            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;

                if ($dataProductVariant['image']) {
                    $dataProductVariant['image'] = Storage::put(self::PATH_UPLOAD_VARIANT, $dataProductVariant['image']);
                }

                ProductVariant::query()->create($dataProductVariant);
            }

            // sync tự động đồng bộ lưu dữ liệu products với tags
            $product->tags()->sync($dataProductTags);

            // sync là thêm vào 
            // attach là xóa đi và nó luôn đi cùng với detach

            foreach ($dataProductGalleries as $image) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => Storage::put(self::PATH_UPLOAD_GALLERY, $image)
                ]);
            }

            DB::commit();

            toastr()->success('Thêm sản phẩm thành công', 'Success', ['timeout' => 2000]);
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Update Product';

        $product = Product::query()->with('catalogue', 'brand', 'tags')->findOrFail($id);

        $catalogue = Catalogue::query()->latest()->get();

        $brand = Brand::query()->latest()->get();

        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $colors = ProductColor::query()->pluck('name', 'id')->all();

        $tags = Tag::query()->pluck('name', 'id')->all();

        $galleries = ProductGallery::query()->where('product_id', $id)->get();

        return view('admin.products.edit', compact('title', 'product', 'catalogue', 'brand', 'sizes', 'colors', 'tags', 'galleries'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        // Lấy thông tin sản phẩm hiện tại từ request
        $dataProduct = $request->except([
            'product_variants',
            'tags',
            'product_galleries',
        ]);

        // Lấy sản phẩm từ DB để cập nhật
        $product = Product::query()->with('catalogue', 'brand', 'tags')->findOrFail($id);

        // Tạo slug mới nếu có thay đổi tên hoặc SKU
        $dataProduct['slug'] = Str::slug($dataProduct['name'], '-' . $dataProduct['sku']);

        // Xử lý hình ảnh thumbnail nếu có file mới được tải lên
        if ($request->hasFile('image_thumbnail')) {
            // Xóa hình ảnh thumbnail cũ từ storage nếu tồn tại
            if ($product->image_thumbnail && Storage::exists($product->image_thumbnail)) {
                Storage::delete($product->image_thumbnail);
            }
            // Lưu hình ảnh thumbnail mới vào storage và cập nhật đường dẫn trong cơ sở dữ liệu
            $dataProduct['image_thumbnail'] = Storage::put(self::PATH_UPLOAD_PRODUCT, $request->file('image_thumbnail'));
        }

        // Lấy danh sách các variant hiện tại của sản phẩm từ DB
        $existingVariants = ProductVariant::query()->where('product_id', $id)->get()->keyBy(function ($item) {
            return $item->product_size_id . '-' . $item->product_color_id;
        });

        // Xử lý các variant từ request
        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $value) {
            $tmp = explode('-', $key);
            $existingVariant = $existingVariants->get($key);

            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $value['quantity'],
                'image' => $value['image'] ?? ($existingVariant ? $existingVariant->image : null),
            ];
        }

        // Lấy danh sách các hình ảnh gallery cũ từ DB
        $oldGalleries = ProductGallery::query()->where('product_id', $id)->pluck('image')->toArray();

        // Xử lý các hình ảnh gallery từ request
        $dataProductGalleries = $request->file('product_galleries') ?: [];
        $newGalleryImages = [];

        $dataProductTags = $request->tags;
        try {
            DB::beginTransaction();

            // Cập nhật thông tin sản phẩm chính
            $product->update($dataProduct);

            // Xử lý các variant
            ProductVariant::query()->where('product_id', $product->id)->delete();
            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;

                if (isset($dataProductVariant['image'])) {
                    $dataProductVariant['image'] = Storage::put(self::PATH_UPLOAD_VARIANT, $dataProductVariant['image']);
                }

                ProductVariant::query()->create($dataProductVariant);
            }

            // sync tự động đồng bộ lưu dữ liệu products với tags
            $product->tags()->sync($dataProductTags);

            // Xử lý các hình ảnh gallery
            foreach ($dataProductGalleries as $image) {
                $path = Storage::put(self::PATH_UPLOAD_GALLERY, $image);
                $newGalleryImages[] = $path;
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }

            // Xóa các hình ảnh gallery cũ không còn tồn tại trong request
            foreach ($oldGalleries as $oldImage) {
                if (!in_array($oldImage, $newGalleryImages)) {
                    ProductGallery::where('product_id', $product->id)->where('image', $oldImage)->delete();
                    Storage::delete($oldImage);
                }
            }

            DB::commit();

            toastr()->success('Cập nhật sản phẩm thành công', 'Success', ['timeout' => 2000]);
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back();
        }
    }



    public function trash()
    {
        $title = 'Product Trash';

        $data = Product::query()->onlyTrashed()->latest('id')->get();

        return view('admin.products.trash', compact('title', 'data'));
    }

    public function delete(string $id)
    {

        try {
            DB::transaction(function () use ($id) {
                $product = Product::query()->findOrFail($id);

                $product->status = 'draft';

                $product->save();

                $product->delete();
            }, 3);

            toastr()->success('Thao tác thành công', 'Success', ['timeout' => 2000]);
            return redirect()->route('admin.products.trash');
        } catch (\Throwable $th) {
            toastr()->error('Đã xảy ra lỗi khi xóa sản phẩm', 'Error', ['timeout' => 2000]);
            return back();
        }
    }

    public function restore(string $id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($product->trashed()) {
            $product->restore();

            return redirect()->route('admin.products.index');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $product = Product::withTrashed()->findOrFail($id);
                if ($product->trashed()) {
                    // xóa dữ liệu bảng trung gian: product_tag
                    $product->tags()->sync([]);

                    if ($product->galleries()) {
                        foreach ($product->galleries as $gallery) {
                            if ($gallery->image && Storage::exists($gallery->image)) {
                                Storage::delete($gallery->image);
                            }
                            $gallery->delete();
                        }
                    }

                    if ($product->variants()) {
                        foreach ($product->variants as $variant) {
                            if ($variant->image && Storage::exists($variant->image)) {
                                Storage::delete($variant->image);
                            }
                            $variant->delete();
                        }
                    }

                    // Delete the product thumbnail image if it exists
                    if ($product->image_thumbnail && Storage::exists($product->image_thumbnail)) {
                        Storage::delete($product->image_thumbnail);
                    }

                    $product->forceDelete();
                }
            }, 3);
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back();
        }
    }
}
