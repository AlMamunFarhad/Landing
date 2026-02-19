
@extends('layouts.app')

@section('content')

<style>
    .page-wrapper {
        max-width: 1100px;
        margin: auto;
    }

    .glass-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        padding: 40px;
    }

    .section-box {
        border: 1px solid #f1f1f1;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        background: #fafafa;
    }

    .section-title {
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 18px;
        border-left: 4px solid #111;
        padding-left: 10px;
    }

    .form-control {
        border-radius: 12px;
        padding: 10px 15px;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #111;
    }

    .submit-btn {
        border-radius: 50px;
        padding: 10px 30px;
        font-weight: 600;
    }

    .page-header {
        font-weight: 800;
        margin-bottom: 30px;
    }

    .video-container iframe {
        width: 100%;
        height: 100%;
        border-radius: 12px;
        border: none;
    }

    .img-preview {
        max-height: 120px;
        display: block;
        margin-top: 10px;
        border-radius: 8px;
    }
</style>

<div class="container py-5">
    <div class="page-wrapper">

        <h2 class="page-header">Update Landing Page</h2>

        <div class="glass-card">

            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pages.update', $page) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- BASIC INFO --}}
                <div class="section-box">
                    <div class="section-title">Basic Information</div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Title *</label>
                            <input type="text" name="title" value="{{ old('title', $page->title) }}" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Slug</label>
                            <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Button Text</label>
                            <input type="text" name="button_text" value="{{ old('button_text', $page->button_text) }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" value="{{ old('contact_number', $page->contact_number) }}" class="form-control">
                        </div>

                        <div class="col-12 form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ $page->is_published ? 'checked' : '' }}>
                            <label class="form-check-label">Published</label>
                        </div>
                    </div>
                </div>

                {{-- HERO SECTION --}}
                <div class="section-box">
                    <div class="section-title">Hero Section</div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Hero Title</label>
                            <input type="text" name="hero_title" value="{{ old('hero_title', $page->hero_title) }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Hero Subtitle</label>
                            <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $page->hero_subtitle) }}" class="form-control">
                        </div>

                        <div class="col-12">
                            <label>YouTube Link</label>
                            <textarea rows="2" name="hero_youtube_link" class="form-control">{{ old('hero_youtube_link', $page->hero_youtube_link) }}</textarea>
                        </div>

                        @if ($page->hero_youtube_link)
                            <div class="col-12 mt-2">
                                <div class="video-container">
                                    <iframe src="{{ $page->hero_youtube_link }}" allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- PRODUCTS SECTION --}}
                <div class="section-box">
                    <div class="section-title">Products Section</div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Product Title</label>
                            <input type="text" name="product_title" value="{{ old('product_title', $page->product_title) }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Product Subtitle</label>
                            <input type="text" name="product_subtitle" value="{{ old('product_subtitle', $page->product_subtitle) }}" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label>Product Image</label>
                            <input type="file" name="product_image" class="form-control" accept="image/*">
                            @if ($page->product_image)
                                <img src="{{ asset($page->product_image) }}" class="img-preview" style="max-height: 100px; width:auto;">
                            @endif
                        </div>

                        <div class="col-12">
                            <label>Product IDs (comma separated)</label>
                            <input type="text" name="product_ids" value="{{ old('product_ids', $page->productIdsString()) }}" class="form-control">
                            <small class="text-muted">Example: 1,2,3</small>
                        </div>
                    </div>
                </div>

                {{-- WHY TRUST US --}}
                <div class="section-box">
                    <div class="section-title">Why Trust Us</div>

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="why_trust_us_title" value="{{ old('why_trust_us_title', $page->why_trust_us_title) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea rows="3" name="why_trust_us_description" id="why_trust_us_description" class="form-control">{{ old('why_trust_us_description', $page->why_trust_us_description) }}</textarea>
                    </div>

                    <div>
                        <label>Image</label>
                        <input type="file" name="why_trust_us_image" class="form-control" accept="image/*">
                        @if ($page->why_trust_us_image)
                            <img src="{{ asset($page->why_trust_us_image) }}" class="img-preview" style="max-height:200px; width:auto;">
                        @endif
                    </div>
                </div>

                {{-- WHY CHOOSE US --}}
                <div class="section-box">
                    <div class="section-title">Why Choose Us</div>

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="why_choose_title" value="{{ old('why_choose_title', $page->why_choose_title) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea rows="3" name="why_choose_description" id="why_choose_description" class="form-control">{{ old('why_choose_description', $page->why_choose_description) }}</textarea>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-dark submit-btn">Update Page</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
