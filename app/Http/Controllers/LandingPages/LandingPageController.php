<?php

namespace App\Http\Controllers\LandingPages;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandingPageRequest;
use App\Models\LandingPage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingPageController extends Controller
{
    public function index()
    {
        $page = LandingPage::where('is_published', 1)->first();

        if (! $page) {
            abort(404);
        }

        $page->why_trust_us_description = $this->fixEditorUrls($page->why_trust_us_description);
        $page->why_choose_description = $this->fixEditorUrls($page->why_choose_description);

        $productImageUrl = $this->getImageUrl($page->product_image);
        $whyImageUrl = $this->getImageUrl($page->why_trust_us_image);
        $embedUrl = $this->getYoutubeEmbedUrl($page->hero_youtube_link);

        // dd($page, $productImageUrl);
        // Single product array for JS
        $products = [
            [
                'name' => $page->product_name,
                'price' => $page->product_price,
                'img' => $productImageUrl,
                'qty' => 1,
                'active' => true,
            ],
        ];

        return view('home.index', compact(
            'page',
            'productImageUrl',
            'whyImageUrl',
            'embedUrl',
            'products'
        ));
    }

    // public function index()
    // {
    //     $page = LandingPage::where('is_published', 1)
    //         ->first();
    //     $productImageUrl = $page->product_image
    //     ? Storage::disk('public')->url($page->product_image)
    //     : asset('assets/images/product.png');

    //     // dd($page->product_image, $productImageUrl);
    //     return view('home.index', compact('page', 'productImageUrl'));
    // }

    // public function index()
    // {
    //     $page = LandingPage::where('is_published', 1)->first();
    //     if (! $page) {
    //         abort(404);
    //     }

    //     // Fix editor produced URLs so <img src="..."> points to accessible URLs
    //     $page->why_trust_us_description = $this->fixEditorUrls($page->why_trust_us_description);
    //     $page->why_choose_description = $this->fixEditorUrls($page->why_choose_description);

    //     // prepare images / embed
    //     $productImageUrl = $this->getImageUrl($page->product_image);
    //     $whyImageUrl = $this->getImageUrl($page->why_trust_us_image);
    //     $embedUrl = $this->getYoutubeEmbedUrl($page->hero_youtube_link);

    //     return view('home.index', compact('page', 'productImageUrl', 'whyImageUrl', 'embedUrl'));
    // }
    // public function index()
    // {
    //     $page = LandingPage::where('is_published', 1)->first();

    //     if (! $page) {
    //         abort(404);
    //     }

    //     // Fix editor image URLs inside descriptions
    //     $page->why_trust_us_description = $this->fixEditorUrls($page->why_trust_us_description);
    //     $page->why_choose_description = $this->fixEditorUrls($page->why_choose_description);

    //     // Single images
    //     $productImageUrl = $this->getImageUrl($page->product_image);
    //     $whyImageUrl = $this->getImageUrl($page->why_trust_us_image);
    //     $embedUrl = $this->getYoutubeEmbedUrl($page->hero_youtube_link);

    //     // ===============================
    //     // Load Related Products
    //     // ===============================

    //     $products = collect();

    //     if (! empty($page->product_id)) {

    //         $productIds = is_array($page->product_id)
    //             ? $page->product_id
    //             : json_decode($page->product_id, true);

    //         $products = Product::whereIn('id', $productIds ?? [])
    //             ->get()
    //             ->map(function ($p) {
    //                 return [
    //                     'id' => $p->id,
    //                     'name' => $p->name,
    //                     'price' => $p->price,
    //                     'img' => $p->product_image
    //                         ? asset('storage/'.$p->product_image)
    //                         : asset('assets/images/product.png'),
    //                     'qty' => 1,
    //                     'active' => false,
    //                 ];
    //             });
    //     }

    //     return view('home.index', compact(
    //         'page',
    //         'productImageUrl',
    //         'whyImageUrl',
    //         'embedUrl',
    //         'products'
    //     ));
    // }

    public function pages()
    {
        $pages = LandingPage::latest()->get();
        $total = LandingPage::count();
        $published = LandingPage::where('is_published', 1)->count();
        $draft = LandingPage::where('is_published', 0)->count();

        return view('pages.pages', compact(
            'pages',
            'total',
            'published',
            'draft'
        ));
    }

    public function create()
    {
        return view('pages.create');
    }

    // helper to parse product ids (example)
    private function parseProductIds(?string $input)
    {
        if (empty($input)) {
            return [];
        }

        // assume comma separated coming from form
        return array_values(array_filter(array_map('trim', explode(',', $input))));
    }

    // public function store(StoreLandingPageRequest $request)
    // {
    //     $data = $request->validated();

    //     // product ids array -> store as json or string as you like
    //     $data['product_id'] = $this->parseProductIds($request->input('product_ids'));

    //     // boolean checkbox
    //     $data['is_published'] = $request->boolean('is_published');

    //     // Product image upload -> store in public/assets/images
    //     if ($request->hasFile('product_image')) {
    //         $file = $request->file('product_image');
    //         $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
    //         $destination = public_path('/assets/images/');
    //         if (!File::exists($destination)) {
    //             File::makeDirectory($destination, 0755, true);
    //         }
    //         $file->move($destination, $filename);
    //         $data['product_image'] = '/assets/images/' . $filename; // save relative to public/
    //     }

    //     // Why Trust Us image upload
    //     if ($request->hasFile('why_trust_us_image')) {
    //         $file = $request->file('why_trust_us_image');
    //         $filename = time() . '_wtu_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
    //         $destination = public_path('/assets/images/');
    //         if (!File::exists($destination)) {
    //             File::makeDirectory($destination, 0755, true);
    //         }
    //         $file->move($destination, $filename);
    //         $data['why_trust_us_image'] = '/assets/images/' . $filename;
    //     }

    //     // slug fallback
    //     if (empty($data['slug'])) {
    //         $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);
    //     }

    //     LandingPage::create($data);

    //     return redirect()->route('pages.index')->with('success', 'Landing page created successfully!');
    // }

    public function store(StoreLandingPageRequest $request)
    {
        $data = $request->validated();

        // product ids array -> store as json or string as you like
        $data['product_id'] = $this->parseProductIds($request->input('product_ids'));

        // boolean checkbox
        $data['is_published'] = $request->boolean('is_published');

        // Ensure slug
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']).'-'.Str::random(5);
        }

        // ===== Upload product_image to storage/app/public/landing_pages =====
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('landing_pages', $filename, 'public'); // e.g. landing_pages/xxx.jpg
            $data['product_image'] = $path;
        }

        // ===== Upload why_trust_us_image to storage/app/public/landing_pages =====
        if ($request->hasFile('why_trust_us_image')) {
            $file = $request->file('why_trust_us_image');
            $filename = time().'_wtu_'.Str::random(8).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('landing_pages', $filename, 'public');
            $data['why_trust_us_image'] = $path;
        }

        LandingPage::create($data);

        // dd($data);
        return redirect()->route('pages.index')->with('success', 'Landing page created successfully!');
    }

    public function edit(LandingPage $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(StoreLandingPageRequest $request, LandingPage $page)
    {
        $data = $request->validated();

        $data['is_published'] = $request->boolean('is_published');
        $data['product_id'] = $this->parseProductIds($request->input('product_ids'));

        if (empty($data['slug'])) {
            $data['slug'] = $page->slug ?? Str::slug($data['title']).'-'.Str::random(5);
        }

        // ===== PRODUCT IMAGE =====
        if ($request->hasFile('product_image')) {

            if (! empty($page->product_image) && Storage::disk('public')->exists($page->product_image)) {
                Storage::disk('public')->delete($page->product_image);
            }

            $file = $request->file('product_image');
            $filename = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('landing_pages', $filename, 'public');

            $data['product_image'] = $path;
        } else {
            unset($data['product_image']);
        }

        // ===== WHY TRUST IMAGE =====
        if ($request->hasFile('why_trust_us_image')) {

            if (! empty($page->why_trust_us_image) && Storage::disk('public')->exists($page->why_trust_us_image)) {
                Storage::disk('public')->delete($page->why_trust_us_image);
            }

            $file = $request->file('why_trust_us_image');
            $filename = time().'_wtu_'.Str::random(8).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('landing_pages', $filename, 'public');

            $data['why_trust_us_image'] = $path;
        } else {
            unset($data['why_trust_us_image']);
        }

        $page->update($data);

        // 🔥 IMPORTANT: Clear cache after update
        Cache::forget("landing_page_{$page->slug}");

        return redirect()->route('pages.index')->with('success', 'Landing page updated successfully.');
    }

    // public function update(StoreLandingPageRequest $request, LandingPage $page)
    // {
    //     $data = $request->validated();

    //     // boolean checkbox
    //     $data['is_published'] = $request->boolean('is_published');

    //     // product ids as array
    //     $data['product_id'] = $this->parseProductIds($request->input('product_ids'));

    //     // slug fallback
    //     if (empty($data['slug'])) {
    //         $data['slug'] = $page->slug ?? Str::slug($data['title']).'-'.Str::random(5);
    //     }

    //     // ---------- product_image ----------
    //     if ($request->hasFile('product_image')) {

    //         // delete old file (storage or public assets)
    //         if (! empty($page->product_image)) {
    //             // if stored in storage disk
    //             if (Storage::disk('public')->exists($page->product_image)) {
    //                 Storage::disk('public')->delete($page->product_image);
    //             } else {
    //                 // maybe old path like "/assets/images/xxx.jpg" or "assets/images/xxx.jpg"
    //                 $oldPublic = ltrim($page->product_image, '/');
    //                 if (File::exists(public_path($oldPublic))) {
    //                     File::delete(public_path($oldPublic));
    //                 }
    //             }
    //         }

    //         // store new file into storage/app/public/landing_pages
    //         $file = $request->file('product_image');
    //         $filename = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
    //         $path = $file->storeAs('landing_pages', $filename, 'public');
    //         $data['product_image'] = $path;
    //     } else {
    //         // do not overwrite DB column if no new file uploaded
    //         unset($data['product_image']);
    //     }

    //     // ---------- why_trust_us_image ----------
    //     if ($request->hasFile('why_trust_us_image')) {

    //         if (! empty($page->why_trust_us_image)) {
    //             if (Storage::disk('public')->exists($page->why_trust_us_image)) {
    //                 Storage::disk('public')->delete($page->why_trust_us_image);
    //             } else {
    //                 $oldPublic = ltrim($page->why_trust_us_image, '/');
    //                 if (File::exists(public_path($oldPublic))) {
    //                     File::delete(public_path($oldPublic));
    //                 }
    //             }
    //         }

    //         $file = $request->file('why_trust_us_image');
    //         $filename = time().'_wtu_'.Str::random(8).'.'.$file->getClientOriginalExtension();
    //         $path = $file->storeAs('landing_pages', $filename, 'public');
    //         $data['why_trust_us_image'] = $path;
    //     } else {
    //         unset($data['why_trust_us_image']);
    //     }

    //     $page->update($data);

    //     return redirect()->route('pages.index')->with('success', 'Landing page updated successfully.');
    // }

    // public function update(StoreLandingPageRequest $request, LandingPage $page)
    // {
    //     $data = $request->validated();

    //     // boolean checkbox
    //     $data['is_published'] = $request->boolean('is_published');

    //     // product ids as array
    //     $data['product_id'] = $this->parseProductIds($request->input('product_ids'));

    //     // product image -> if new uploaded, delete old from public and save new
    //     if ($request->hasFile('product_image')) {
    //         // delete old if exists
    //         if (! empty($page->product_image) && File::exists(public_path($page->product_image))) {
    //             File::delete(public_path($page->product_image));
    //         }
    //         $file = $request->file('product_image');
    //         $filename = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
    //         $destination = public_path('/assets/images');
    //         if (! File::exists($destination)) {
    //             File::makeDirectory($destination, 0755, true);
    //         }
    //         $file->move($destination, $filename);
    //         $data['product_image'] = '/assets/images/'.$filename;
    //     } else {
    //         // do not overwrite DB column if no new file uploaded
    //         unset($data['product_image']);
    //     }

    //     // why trust us image
    //     if ($request->hasFile('why_trust_us_image')) {
    //         if (! empty($page->why_trust_us_image) && File::exists(public_path($page->why_trust_us_image))) {
    //             File::delete(public_path($page->why_trust_us_image));
    //         }
    //         $file = $request->file('why_trust_us_image');
    //         $filename = time().'_wtu_'.Str::random(8).'.'.$file->getClientOriginalExtension();
    //         $destination = public_path('/assets/images');
    //         if (! File::exists($destination)) {
    //             File::makeDirectory($destination, 0755, true);
    //         }
    //         $file->move($destination, $filename);
    //         $data['why_trust_us_image'] = '/assets/images/'.$filename;
    //     } else {
    //         unset($data['why_trust_us_image']);
    //     }

    //     if (empty($data['slug'])) {
    //         $data['slug'] = $page->slug ?? Str::slug($data['title']).'-'.Str::random(5);
    //     }

    //     $page->update($data);

    //     return redirect()->route('pages.index')->with('success', 'Landing page updated successfully.');
    // }

    //     public function show(LandingPage $page)
    // {
    //     if (! $page->is_published) {
    //         abort(404);
    //     }

    //     // cache by slug
    //     $cacheKey = "landing_page_{$page->slug}";

    //     $page = Cache::remember($cacheKey, 60 * 24, function () use ($page) {
    //         return $page;
    //     });

    //     // prepare dynamic content
    //     $embedUrl = $this->getYoutubeEmbedUrl($page->hero_youtube_link);
    //     $whyImageUrl = $this->getImageUrl($page->why_trust_us_image);

    //     $page->why_trust_us_description = $this->fixEditorUrls($page->why_trust_us_description);
    //     $page->why_choose_description = $this->fixEditorUrls($page->why_choose_description);

    //     return view('pages.show', compact('page', 'embedUrl', 'whyImageUrl'));
    // }

    public function show(LandingPage $page)
    {
        if (! $page->is_published) {
            abort(404);
        }

        // cache by slug
        $cacheKey = "landing_page_{$page->slug}";

        $page = Cache::remember($cacheKey, 60 * 24, function () use ($page) {
            return $page;
        });

        // prepare dynamic content
        $embedUrl = $this->getYoutubeEmbedUrl($page->hero_youtube_link);
        $whyImageUrl = $this->getImageUrl($page->why_trust_us_image);

        $page->why_trust_us_description = $this->fixEditorUrls($page->why_trust_us_description);
        $page->why_choose_description = $this->fixEditorUrls($page->why_choose_description);
        $productImageUrl = $page->product_image
        ? Storage::disk('public')->url($page->product_image)
        : asset('assets/images/product.png');

        // dd($page->product_image, $productImageUrl);

        // dd($page);

        return view('pages.show', compact('page', 'embedUrl', 'whyImageUrl', 'productImageUrl'));
    }

    /* ===============================
       Helper: YouTube Embed Convert
    =============================== */
    private function getYoutubeEmbedUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        if (str_contains($url, 'youtube.com/embed')) {
            return $url;
        }

        if (preg_match('/v=([a-zA-Z0-9_-]+)/', $url, $m)) {
            return "https://www.youtube.com/embed/{$m[1]}";
        }

        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $m)) {
            return "https://www.youtube.com/embed/{$m[1]}";
        }

        if (preg_match('/^[a-zA-Z0-9_-]+$/', trim($url))) {
            return 'https://www.youtube.com/embed/'.trim($url);
        }

        return null;
    }

    /* ===============================
       Helper: Image URL Resolver
    =============================== */
    private function getImageUrl(?string $path): string
    {
        $default = asset('assets/images/product.png');

        if (! $path) {
            return $default;
        }

        if (preg_match('/^https?:\/\//', $path)) {
            return $path;
        }

        $clean = ltrim($path, '/');

        if (Storage::disk('public')->exists($clean)) {
            return Storage::disk('public')->url($clean);
        }

        if (file_exists(public_path($clean))) {
            return asset($clean);
        }

        return $default;
    }

    /* ===============================
       Helper: Fix Editor Image Paths
    =============================== */
    private function fixEditorUrls(?string $html): ?string
    {
        if (! $html) {
            return $html;
        }

        return preg_replace_callback('/src=[\'"]([^\'"]+)[\'"]/', function ($m) {

            $src = $m[1];

            if (preg_match('/^https?:\/\//', $src)) {
                return 'src="'.$src.'"';
            }

            $clean = ltrim($src, '/');

            if (Storage::disk('public')->exists($clean)) {
                return 'src="'.Storage::disk('public')->url($clean).'"';
            }

            if (file_exists(public_path($clean))) {
                return 'src="'.asset($clean).'"';
            }

            return 'src="'.asset($clean).'"';

        }, $html);
    }

    public function destroy(LandingPage $page)
    {
        // delete images from storage disk
        if (! empty($page->product_image) && Storage::disk('public')->exists($page->product_image)) {
            Storage::disk('public')->delete($page->product_image);
        }

        if (! empty($page->why_trust_us_image) && Storage::disk('public')->exists($page->why_trust_us_image)) {
            Storage::disk('public')->delete($page->why_trust_us_image);
        }

        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Landing page deleted successfully.');
    }
}
