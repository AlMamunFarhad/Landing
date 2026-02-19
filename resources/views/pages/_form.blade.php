@php $editing = isset($page); @endphp

<div class="container my-5">
    <div class="page-container">
        <div class="custom-card">
            <div class="card-top">
                <h3>{{ $editing ? 'Update Landing Page' : 'Create Landing Page' }}</h3>
            </div>

            <form action="{{ $editing ? route('pages.update', $page->getKey()) : route('pages.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if($editing) @method('PUT') @endif

                {{-- BASIC INFO --}}
                <div class="section">
                    <div class="section-title">Basic Information</div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label>Title *</label>
                            <input type="text" name="title"
                                   value="{{ old('title', $editing ? $page->title : '') }}"
                                   class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Slug</label>
                            <input type="text" name="slug"
                                   value="{{ old('slug', $editing ? $page->slug : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Button Text</label>
                            <input type="text" name="button_text"
                                   value="{{ old('button_text', $editing ? $page->button_text : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number"
                                   value="{{ old('contact_number', $editing ? $page->contact_number : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-12 form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1"
                                   {{ old('is_published', $editing ? $page->is_published : false) ? 'checked' : '' }}>
                            <label class="form-check-label">Published</label>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- HERO SECTION --}}
                <div class="section">
                    <div class="section-title">Hero Section</div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label>Hero Title</label>
                            <input type="text" name="hero_title"
                                   value="{{ old('hero_title', $editing ? $page->hero_title : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Hero Subtitle</label>
                            <input type="text" name="hero_subtitle"
                                   value="{{ old('hero_subtitle', $editing ? $page->hero_subtitle : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-12 form-group">
                            <label>YouTube Link</label>
                            <textarea rows="2" name="hero_youtube_link" class="form-control">{{ old('hero_youtube_link', $editing ? $page->hero_youtube_link : '') }}</textarea>
                        </div>
                        @if($editing && $page->hero_youtube_link)
                            <div class="col-12 mt-2">
                                <div class="video-container">
                                    <iframe width="560" height="315"
                                            src="{{ $page->hero_youtube_link }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                {{-- PRODUCTS SECTION --}}
                <div class="section">
                    <div class="section-title">Products Section</div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label>Product Title</label>
                            <input type="text" name="product_title"
                                   value="{{ old('product_title', $editing ? $page->product_title : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Product Subtitle</label>
                            <input type="text" name="product_subtitle"
                                   value="{{ old('product_subtitle', $editing ? $page->product_subtitle : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Product Image</label>
                            <input type="file" name="product_image" class="form-control" accept="image/*">
                            @if($editing && $page->product_image)
                                <img src="{{ asset('storage/'.$page->product_image) }}" class="img-thumbnail mt-2" style="max-height:120px;">
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>Product IDs (comma separated)</label>
                            <input type="text" name="product_ids"
                                   value="{{ old('product_ids', $editing ? $page->productIdsString() : '') }}"
                                   class="form-control">
                            <small class="text-muted">Stored as JSON in database</small>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- WHY TRUST US --}}
                <div class="section">
                    <div class="section-title">Why Trust Us</div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="why_trust_us_title"
                               value="{{ old('why_trust_us_title', $editing ? $page->why_trust_us_title : '') }}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="3" name="why_trust_us_description" class="form-control">{{ old('why_trust_us_description', $editing ? $page->why_trust_us_description : '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="why_trust_us_image" class="form-control" accept="image/*">
                        @if($editing && $page->why_trust_us_image)
                            <img src="{{ asset('storage/'.$page->why_trust_us_image) }}" class="img-thumbnail mt-2" style="max-height:120px;">
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                {{-- WHY CHOOSE US --}}
                <div class="section">
                    <div class="section-title">Why Choose Us</div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="why_choose_title"
                               value="{{ old('why_choose_title', $editing ? $page->why_choose_title : '') }}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="3" name="why_choose_description" class="form-control">{{ old('why_choose_description', $editing ? $page->why_choose_description : '') }}</textarea>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        {{ $editing ? 'Update Page' : 'Create Page' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- @php
$editing = isset($page);
@endphp

<div class="container my-5">
    <div class="page-container">
        <div class="custom-card">
            <div class="card-top">
                <h3>{{ $editing ? 'Update Landing Page' : 'Create Landing Page' }}</h3>
            </div>

            <form action="{{ $editing ? route('pages.update', $page->getKey()) : route('pages.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if($editing) @method('PUT') @endif

                <div class="section">
                    <div class="section-title">Basic Information</div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label>Title *</label>
                            <input type="text" name="title"
                                   value="{{ old('title', $editing ? $page->title : '') }}"
                                   class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Slug</label>
                            <input type="text" name="slug"
                                   value="{{ old('slug', $editing ? $page->slug : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Button Text</label>
                            <input type="text" name="button_text"
                                   value="{{ old('button_text', $editing ? $page->button_text : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number"
                                   value="{{ old('contact_number', $editing ? $page->contact_number : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-12 form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1"
                                   {{ old('is_published', $editing ? $page->is_published : false) ? 'checked' : '' }}>
                            <label class="form-check-label">Published</label>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="section">
                    <div class="section-title">Hero Section</div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label>Hero Title</label>
                            <input type="text" name="hero_title"
                                   value="{{ old('hero_title', $editing ? $page->hero_title : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Hero Subtitle</label>
                            <input type="text" name="hero_subtitle"
                                   value="{{ old('hero_subtitle', $editing ? $page->hero_subtitle : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-12 form-group">
                            <label>YouTube Link</label>
                            <textarea rows="2" name="hero_youtube_link" class="form-control">{{ old('hero_youtube_link', $editing ? $page->hero_youtube_link : '') }}</textarea>
                        </div>
                        @if($editing && $page->hero_youtube_link)
                            <div class="col-12 mt-2">
                                <div class="video-container">
                                    <iframe width="560" height="315"
                                            src="{{ $page->hero_youtube_link }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                <div class="section">
                    <div class="section-title">Products Section</div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label>Product Title</label>
                            <input type="text" name="product_title"
                                   value="{{ old('product_title', $editing ? $page->product_title : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Product Subtitle</label>
                            <input type="number" step="0.01" name="product_subtitle"
                                   value="{{ old('product_subtitle', $editing ? $page->product_subtitle : '') }}"
                                   class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Product Image</label>
                            <input type="file" name="product_image" class="form-control" accept="image/*">
                            @if($editing && $page->product_image)
                                <img src="{{ asset('storage/'.$page->product_image) }}" class="img-thumbnail mt-2" style="max-height:120px;">
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>Product IDs (comma separated)</label>
                            <input type="text" name="product_ids"
                                   value="{{ old('product_ids', $editing ? $page->productIdsString() : '') }}"
                                   class="form-control">
                            <small class="text-muted">Stored as JSON in database</small>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="section">
                    <div class="section-title">Why Trust Us</div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="why_trust_us_title"
                               value="{{ old('why_trust_us_title', $editing ? $page->why_trust_us_title : '') }}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="3" name="why_trust_us_description" class="form-control">{{ old('why_trust_us_description', $editing ? $page->why_trust_us_description : '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="why_trust_us_image" class="form-control" accept="image/*">
                        @if($editing && $page->why_trust_us_image)
                            <img src="{{ asset('storage/'.$page->why_trust_us_image) }}" class="img-thumbnail mt-2" style="max-height:120px;">
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                <div class="section">
                    <div class="section-title">Why Choose Us</div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="why_choose_title"
                               value="{{ old('why_choose_title', $editing ? $page->why_choose_title : '') }}"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="3" name="why_choose_description" class="form-control">{{ old('why_choose_description', $editing ? $page->why_choose_description : '') }}</textarea>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        {{ $editing ? 'Update Page' : 'Create Page' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
 --}}







{{--
@php
$editing = isset($page) && $page instanceof \App\Models\LandingPage;
@endphp

<div class="container my-5">
    <div class="page-container">
        <div class="custom-card">
            <div class="card-top">
                <h3>{{ $editing ? 'Update Landing Page' : 'Create Landing Page' }}</h3>
            </div>

            <form action="{{ $editing ? route('pages.update', $page) : route('pages.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if($editing) @method('PUT') @endif

                <div class="section mb-4">
                    <div class="section-title">Basic Information</div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label>Title *</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title', $editing ? $page->title : '') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control"
                                   value="{{ old('slug', $editing ? $page->slug : '') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Button Text</label>
                            <input type="text" name="button_text" class="form-control"
                                   value="{{ old('button_text', $editing ? $page->button_text : '') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" class="form-control"
                                   value="{{ old('contact_number', $editing ? $page->contact_number : '') }}">
                        </div>
                        <div class="col-12 switch mt-2">
                            <input type="checkbox" name="is_published" value="1"
                                   {{ old('is_published', $editing ? $page->is_published : false) ? 'checked' : '' }}>
                            <label class="mb-0">Published</label>
                        </div>
                    </div>
                </div>

                <div class="section mb-4">
                    <div class="section-title">Hero Section</div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label>Hero Title</label>
                            <input type="text" name="hero_title" class="form-control"
                                   value="{{ old('hero_title', $editing ? $page->hero_title : '') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Hero Subtitle</label>
                            <input type="text" name="hero_subtitle" class="form-control"
                                   value="{{ old('hero_subtitle', $editing ? $page->hero_subtitle : '') }}">
                        </div>
                        <div class="col-12 form-group">
                            <label>YouTube Link</label>
                            <textarea name="hero_youtube_link" rows="2" class="form-control">{{ old('hero_youtube_link', $editing ? $page->hero_youtube_link : '') }}</textarea>
                        </div>

                        @if($editing && $page->hero_youtube_link)
                            @php
                                preg_match("/(?:v=|\/)([0-9A-Za-z_-]{11})/", $page->hero_youtube_link, $matches);
                                $video_id = $matches[1] ?? null;
                            @endphp
                            @if($video_id)
                                <div class="col-12 mt-2">
                                    <div class="video-container">
                                        <iframe width="560" height="315"
                                                src="https://www.youtube.com/embed/{{ $video_id }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="section mb-4">
                    <div class="section-title">Products Section</div>
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label>Product Title</label>
                            <input type="text" name="product_title" class="form-control"
                                   value="{{ old('product_title', $editing ? $page->product_title : '') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Product Subtitle</label>
                            <input type="number" step="0.01" name="product_subtitle" class="form-control"
                                   value="{{ old('product_subtitle', $editing ? $page->product_subtitle : '') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Product Image</label>
                            <input type="file" name="product_image" class="form-control">
                            @if($editing && $page->product_image)
                                <img src="{{ asset('storage/'.$page->product_image) }}" class="img-thumbnail mt-2" style="max-height:120px;">
                            @endif
                        </div>
                        <div class="col-12 form-group">
                            <label>Product IDs</label>
                            <input type="text" name="product_ids" class="form-control"
                                   value="{{ old('product_ids', $editing ? $page->productIdsString() : '') }}">
                            <div class="small-text">Example: 1,2,3 (Stored as JSON)</div>
                        </div>
                    </div>
                </div>

                <div class="section mb-4">
                    <div class="section-title">Why Trust Us</div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="why_trust_us_title" class="form-control"
                               value="{{ old('why_trust_us_title', $editing ? $page->why_trust_us_title : '') }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="why_trust_us_description" rows="3" class="form-control">{{ old('why_trust_us_description', $editing ? $page->why_trust_us_description : '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="why_trust_us_image" class="form-control">
                        @if($editing && $page->why_trust_us_image)
                            <img src="{{ asset('storage/'.$page->why_trust_us_image) }}" class="img-thumbnail mt-2" style="max-height:120px;">
                        @endif
                    </div>
                </div>

                <div class="section mb-4">
                    <div class="section-title">Why Choose Us</div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="why_choose_title" class="form-control"
                               value="{{ old('why_choose_title', $editing ? $page->why_choose_title : '') }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="why_choose_description" rows="3" class="form-control">{{ old('why_choose_description', $editing ? $page->why_choose_description : '') }}</textarea>
                    </div>
                </div>

                <div class="text-end mb-4">
                    <button type="submit" class="btn btn-primary px-4">
                        {{ $editing ? 'Update Page' : 'Create Page' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
/* Simple modern styling */
.container { max-width: 900px; }
.custom-card { background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 20px; }
.card-top h3 { margin-bottom: 20px; color: #222; }
.section-title { font-weight: 600; color: #007BFF; margin-bottom: 15px; font-size: 18px; }
.form-control { border-radius: 8px; padding: 8px 12px; border: 1px solid #ccc; }
.img-thumbnail { border-radius: 8px; }
button.btn { border-radius: 8px; background: #007BFF; color: #fff; }
.video-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; }
.video-container iframe { position: absolute; top:0; left:0; width:100%; height:100%; }
</style>

 --}}



{{--
@php
$editing = isset($page);
@endphp
<div class="container">

<div class="page-container">
    <div class="custom-card">

        <div class="card-top">
            <h3>{{ $editing ? 'Update Landing Page' : 'Create Landing Page' }}</h3>
        </div>

        <form action="{{ $editing ? route('pages.update',$page->id) : route('pages.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @if($editing) @method('PUT') @endif

            <div class="section">
                <div class="section-title">Basic Information</div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Title *</label>
                        <input type="text" name="title"
                               value="{{ old('title',$editing?$page->title:'') }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Slug</label>
                        <input type="text" name="slug"
                               value="{{ old('slug',$editing?$page->slug:'') }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Button Text</label>
                        <input type="text" name="button_text"
                               value="{{ old('button_text',$editing?$page->button_text:'') }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Contact Number</label>
                        <input type="text" name="contact_number"
                               value="{{ old('contact_number',$editing?$page->contact_number:'') }}">
                    </div>

                    <div class="col-12 switch mt-2">
                        <input type="checkbox" name="is_published" value="1"
                        {{ old('is_published',$editing?$page->is_published:false)?'checked':'' }}>
                        <label class="mb-0">Published</label>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Hero Section</div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Hero Title</label>
                        <input type="text" name="hero_title"
                               value="{{ old('hero_title',$editing?$page->hero_title:'') }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Hero Subtitle</label>
                        <input type="text" name="hero_subtitle"
                               value="{{ old('hero_subtitle',$editing?$page->hero_subtitle:'') }}">
                    </div>

                    <div class="col-12 form-group">
                        <label>YouTube Link</label>
                        <textarea rows="2" name="hero_youtube_link">{{ old('hero_youtube_link',$editing?$page->hero_youtube_link:'') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Products Section</div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Product Title</label>
                        <input type="text" name="product_title"
                               value="{{ old('product_title',$editing?$page->product_title:'') }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Product Subtitle</label>
                        <input type="number" step="0.01"
                               name="product_subtitle"
                               value="{{ old('product_subtitle',$editing?$page->product_subtitle:'') }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Product Image</label>
                        <input type="file" name="product_image">
                        @if($editing && $page->product_image)
                            <img src="{{ asset('storage/'.$page->product_image) }}"
                                 class="image-preview">
                        @endif
                    </div>

                    <div class="col-12 form-group">
                        <label>Product IDs</label>
                        <input type="text" name="product_ids"
                               value="{{ old('product_ids',$editing?$page->productIdsString():'') }}">
                        <div class="small-text">Example: 1,2,3 (Stored as JSON)</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Why Trust Us</div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="why_trust_us_title"
                           value="{{ old('why_trust_us_title',$editing?$page->why_trust_us_title:'') }}">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="3" name="why_trust_us_description">{{ old('why_trust_us_description',$editing?$page->why_trust_us_description:'') }}</textarea>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Why Choose Us</div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="why_choose_title"
                           value="{{ old('why_choose_title',$editing?$page->why_choose_title:'') }}">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="3" name="why_choose_description">{{ old('why_choose_description',$editing?$page->why_choose_description:'') }}</textarea>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="submit-btn order-btn-id" style="border: none">
                        {{ $editing ? 'Update Page' : 'Create Page' }}
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
</div> --}}
