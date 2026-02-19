<?php

namespace App\Http\Controllers\LandingPages;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandingPageRequest;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingPageController extends Controller
{

    public function index()
    {
        $page = LandingPage::where('is_published', 1)
            ->first();
        return view('home.index', compact('page'));
    }

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
        if (empty($input)) return [];
        // assume comma separated coming from form
        return array_values(array_filter(array_map('trim', explode(',', $input))));
    }

    public function store(StoreLandingPageRequest $request)
    {
        $data = $request->validated();

        // product ids array -> store as json or string as you like
        $data['product_id'] = $this->parseProductIds($request->input('product_ids'));

        // boolean checkbox
        $data['is_published'] = $request->boolean('is_published');

        // Product image upload -> store in public/assets/images
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('/assets/images/');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['product_image'] = '/assets/images/' . $filename; // save relative to public/
        }

        // Why Trust Us image upload
        if ($request->hasFile('why_trust_us_image')) {
            $file = $request->file('why_trust_us_image');
            $filename = time() . '_wtu_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('/assets/images/');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['why_trust_us_image'] = '/assets/images/' . $filename;
        }

        // slug fallback
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);
        }

        LandingPage::create($data);

        return redirect()->route('home')->with('success', 'Landing page created successfully!');
    }

    public function show(LandingPage $pages)
    {

        if (! $pages->is_published) {
            abort(404);
        }

        return view('pages.show', compact('pages'));
    }
    public function showBySlug($slug)
    {
        $cacheKey = "landing_page_{$slug}";

        $page = Cache::remember($cacheKey, 60 * 24, function () use ($slug) {
            return LandingPage::where('slug', $slug)
                ->where('is_published', 1)
                ->first();
        });

        if (! $page) {
            Cache::forget($cacheKey);
            abort(404);
        }

        // ensure it's the model instance
        if (! $page instanceof LandingPage) {
            Cache::forget($cacheKey);
            $page = LandingPage::where('slug', $slug)
                ->where('is_published', 1)
                ->firstOrFail();
        }

        return view('pages.show', compact('page'));
    }


    public function preview(LandingPage $page)
    {
        return view('pages.show', compact('page'));
    }

    public function edit(LandingPage $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(StoreLandingPageRequest $request, LandingPage $page)
    {
        $data = $request->validated();

        // boolean checkbox
        $data['is_published'] = $request->boolean('is_published');

        // product ids as array
        $data['product_id'] = $this->parseProductIds($request->input('product_ids'));

        // product image -> if new uploaded, delete old from public and save new
        if ($request->hasFile('product_image')) {
            // delete old if exists
            if (!empty($page->product_image) && File::exists(public_path($page->product_image))) {
                File::delete(public_path($page->product_image));
            }
            $file = $request->file('product_image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('/assets/images');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['product_image'] = '/assets/images/' . $filename;
        } else {
            // do not overwrite DB column if no new file uploaded
            unset($data['product_image']);
        }

        // why trust us image
        if ($request->hasFile('why_trust_us_image')) {
            if (!empty($page->why_trust_us_image) && File::exists(public_path($page->why_trust_us_image))) {
                File::delete(public_path($page->why_trust_us_image));
            }
            $file = $request->file('why_trust_us_image');
            $filename = time() . '_wtu_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('/assets/images');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['why_trust_us_image'] = '/assets/images/' . $filename;
        } else {
            unset($data['why_trust_us_image']);
        }

        if (empty($data['slug'])) {
            $data['slug'] = $page->slug ?? Str::slug($data['title']) . '-' . Str::random(5);
        }

        $page->update($data);

        return redirect()->route('pages')->with('success', 'Landing page updated successfully.');
    }

    public function destroy(LandingPage $page)
    {
        // delete images if exist (from public/)
        if (!empty($page->product_image) && File::exists(public_path($page->product_image))) {
            File::delete(public_path($page->product_image));
        }
        if (!empty($page->why_trust_us_image) && File::exists(public_path($page->why_trust_us_image))) {
            File::delete(public_path($page->why_trust_us_image));
        }

        $page->delete();

        return redirect()->route('pages')->with('success', 'Landing page deleted successfully.');
    }
}
