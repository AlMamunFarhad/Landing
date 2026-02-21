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
</style>

<div class="container py-5">
    <div class="page-wrapper">

        <h2 class="page-header">Create Landing Page</h2>

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

            <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- BASIC INFO --}}
                <div class="section-box">
                    <div class="section-title">Basic Information</div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Title *</label>
                            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                        </div>

                        <div class="col-md-6">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                        </div>

                        <div class="col-md-6">
                            <label>Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="{{ old('button_text') }}">
                        </div>

                        <div class="col-md-6">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}">
                        </div>

                        <div class="col-12 form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1">
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
                            <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title') }}">
                        </div>

                        <div class="col-md-6">
                            <label>Hero Subtitle</label>
                            <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle') }}">
                        </div>

                        <div class="col-12">
                            <label>YouTube Link</label>
                            <textarea rows="2" name="hero_youtube_link" class="form-control">{{ old('hero_youtube_link') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- PRODUCTS SECTION --}}
                <div class="section-box">
                    <div class="section-title">Products Section</div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Product Title</label>
                            <input type="text" name="product_title" class="form-control" value="{{ old('product_title') }}">
                        </div>

                        <div class="col-md-6">
                            <label>Product Subtitle</label>
                            <input type="number" name="product_subtitle" class="form-control" value="{{ old('product_subtitle') }}">
                        </div>

                        <div class="col-md-6">
                            <label>Product Image</label>
                            <input type="file" name="product_image" class="form-control">
                        </div>

                        <div class="col-12">
                            <label>Product IDs (comma separated)</label>
                            <input type="text" name="product_ids" class="form-control" value="{{ old('product_ids') }}">
                            <small class="text-muted">Example: 1,2,3</small>
                        </div>
                    </div>
                </div>

                {{-- WHY TRUST US --}}
                <div class="section-box">
                    <div class="section-title">Why Trust Us</div>

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="why_trust_us_title" class="form-control" value="{{ old('why_trust_us_title') }}">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea rows="3" name="why_trust_us_description" id="why_trust_us_description" class="form-control">{{ old('why_trust_us_description') }}</textarea>
                    </div>

                    <div>
                        <label>Image</label>
                        <input type="file" name="why_trust_us_image" class="form-control" >
                    </div>
                </div>

                {{-- WHY CHOOSE US --}}
                <div class="section-box">
                    <div class="section-title">Why Choose Us</div>

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="why_choose_title" class="form-control" value="{{ old('why_choose_title') }}">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea rows="3" name="why_choose_description" id="why_choose_description" class="form-control">{{ old('why_choose_description') }}</textarea>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-dark submit-btn">
                        Create Page
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
