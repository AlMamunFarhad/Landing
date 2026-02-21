@extends('layouts.app')
@section('content')
    {{-- @foreach ($page as $p) --}}
    <!-- Header Section -->
    <section class="header-section">
        <div class="container">
            <h1>{{ $page->hero_title }}</h1>
            <p>{{ $page->hero_subtitle }}</p>
        </div>
    </section>

    <!-- Video Section -->
    <section class="video-section fade-in">
        <div class="container">
            <div class="video-container">
                <iframe width="560" height="315" src="{{ $page->hero_youtube_link }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="text-center">
                <a href="#order-sec-id" class="order-btn-id">
                    <span><i class="fa-solid fa-house"></i></span> {{ $page->button_text }}
                </a>
                <br>
                <a href="tel:01869684533" class="order-number-btn mt-4">
                    <span><i class="fas fa-phone me-2"></i></span> {{ $page->contact_number }}
                </a>
            </div>
        </div>
    </section>


    <!-- Spices Section -->
    <section class="spices-section fade-in">
        <h2>যে সকল উপাদান তৈরি:</h2>
        <div class="swiper spices-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="মরিচ গুড়া">
                        <p>মরিচ গুড়া</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="হলুদ">
                        <p>হলুদ</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="জিরা গুড়া">
                        <p>জিরা গুড়া</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="ধনিয়া">
                        <p>ধনিয়া</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="তেজ পাতা">
                        <p>তেজ পাতা</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="দারুচিনি">
                        <p>দারুচিনি</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="এলাচ">
                        <p>এলাচ</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="গরম মসলা">
                        <p>গরম মসলা</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="মরিচ গুড়া">
                        <p>মরিচ গুড়া</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="হলুদ">
                        <p>হলুদ</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="জিরা গুড়া">
                        <p>জিরা গুড়া</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="ধনিয়া">
                        <p>ধনিয়া</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="তেজ পাতা">
                        <p>তেজ পাতা</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="দারুচিনি">
                        <p>দারুচিনি</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="এলাচ">
                        <p>এলাচ</p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="spice-item">
                        <img src="{{ asset('assets/images/product-slide.png') }}" alt="গরম মসলা">
                        <p>গরম মসলা</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="#order-sec-id" class="order-btn-id">
                <span><i class="fa-solid fa-house"></i></span> {{ $page->button_text }}
            </a>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section fade-in">
        <div class="container">
            <div class="benefits-header">
                {{ $page->why_trust_us_title }}
            </div>
            <div class="benefits-content">
                {{-- <ul class="benefits-list">
                    <li></li>
                </ul> --}}
                <div>
                    {!! $page->why_trust_us_description !!}
                </div>
                <div class="benefits-image">
                    <img src="{{ asset('storage/' . $page->why_trust_us_image) }}" class="img-fluid img-responsive"
                        alt="মশলা পণ্য">
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#order-sec-id" class="order-btn-id">
                    <span><i class="fa-solid fa-house"></i></span> {{ $page->button_text }}
                </a>
                <br>
                <a href="tel:{{ $page->contact_number }}" class="order-number-btn mt-4">
                    <span><i class="fas fa-phone me-2"></i></span> {{ $page->contact_number }}
                </a>
            </div>
        </div>
    </section>

    <!-- Usage Section -->
    <section class="usage-section fade-in">
        <div class="container">
            <div class="usage-content-main">
                <div class="usage-header">
                    {{ $page->why_choose_title }}
                </div>
                <div>
                 {!! $page->why_choose_description !!}
                </div>
                <div class="text-center mt-4">
                    <a href="#order-sec-id" class="order-btn-id">
                        <span><i class="fa-solid fa-house"></i></span> {{ $page->button_text }}
                    </a>
                    <br>
                    <a href="tel:{{ $page->contact_number }}" class="order-number-btn mt-4">
                        <span><i class="fas fa-phone me-2"></i></span> {{ $page->contact_number }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section fade-in">
        <div class="container">
            <div class="pricing-content">
                <div class="price-box mb-5">
                    <h2 class="price">মশলা মসলা (২০০ গ্রাম) = ২৫০ টাকা</h2>
                </div>
                <div class="price-box">
                    <h2 class="price">মশলা মসলা (৫০০ গ্রাম) = ১৫০০ টাকা </h2>
                </div>

                <div class="text-center mt-2">
                    <a href="#order-sec-id" class="order-btn-id">
                        <span><i class="fa-solid fa-house"></i></span> {{ $page->button_text }}
                    </a>
                    <br>
                    <a href="tel:{{ $page->contact_number }}" class="order-number-btn mt-4">
                        <span><i class="fas fa-phone me-2"></i></span> {{ $page->contact_number }}
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Order Form Section -->
    <section class="order-section fade-in" id="order-sec-id">
        <div class="container">
            <div class="order-content-main">
                <div class="order-header">অর্ডার করতে নিচের ফর্মটি পূরণ করুন</div>
                <div class="order-form-container">

                    <!-- LEFT: Billing Details -->
                    <div class="billing-details">
                        <h4>Billing details</h4>
                        <form id="orderForm">
                            <div class="form-group">
                                <label>আপনার নাম <span class="req">*</span></label>
                                <input type="text" id="custName" required placeholder="">
                            </div>
                            <div class="form-group">
                                <label>মোবাইল নাম্বার <span class="req">*</span></label>
                                <input type="tel" id="custPhone" required placeholder="">
                            </div>
                            <div class="form-group">
                                <label>সম্পূর্ণ ঠিকানা <span class="req">*</span></label>
                                <input type="text" id="custAddress" required placeholder="">
                            </div>
                        </form>
                    </div>

                    <!-- RIGHT: Select Product + Order Summary -->
                    <div class="order-summary">

                        <!-- Select Product -->
                        <h4>Select Product</h4>

                        <!-- Product 1 -->
                        <div class="select-product-card active" data-product="0">
                            <div class="sp-radio">
                                <div class="sp-radio-dot"></div>
                            </div>
                            <img class="sp-img" src="{{ asset('storage/' . $page->product_image) }}" alt="মশলা">
                            <div class="sp-meta">
                                <div class="sp-name">শাহী গরম মশলা (২০০ গ্রাম) × <span class="qty-display">1</span>
                                </div>
                                <div class="qty-stepper">
                                    <button class="qty-btn qty-minus" type="button">−</button>
                                    <div class="qty-val">1</div>
                                    <button class="qty-btn qty-plus" type="button">+</button>
                                </div>
                            </div>
                            <div class="sp-price">৬৫০.০০ ৳</div>
                        </div>

                        <!-- Product 2 -->
                        <div class="select-product-card" data-product="1">
                            <div class="sp-radio">
                                <div class="sp-radio-dot"></div>
                            </div>
                            <img class="sp-img" src="{{ asset('storage/' . $page->product_image) }}" alt="মশলা">
                            <div class="sp-meta">
                                <div class="sp-name">শাহী গরম মশলা (৫০০ গ্রাম) × <span class="qty-display">1</span>
                                </div>
                                <div class="qty-stepper">
                                    <button class="qty-btn qty-minus" type="button">−</button>
                                    <div class="qty-val">1</div>
                                    <button class="qty-btn qty-plus" type="button">+</button>
                                </div>
                            </div>
                            <div class="sp-price">১,৫০০.০০ ৳</div>
                        </div>

                        <!-- Your Order -->
                        <div class="your-order-box">
                            <h5>Your order</h5>
                            <table class="yo-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="orderTableBody">
                                    <!-- filled by JS -->
                                </tbody>
                            </table>

                            <div style="margin-top:6px;">
                                <!-- Subtotal -->
                                <div class="yo-row">
                                    <span>Subtotal</span>
                                    <span id="subtotalDisplay">৬৫০.০০ ৳</span>
                                </div>

                                <!-- Shipping with radio -->
                                <div class="yo-row" style="align-items:flex-start;">
                                    <span>Shipping</span>
                                    <div class="shipping-options" id="shippingOptions">
                                        <label>
                                            <input type="radio" name="shipping" value="60" checked>
                                            <span>ঢাকার মধ্যে: <strong>৬০.০০ ৳</strong></span>
                                        </label>
                                        <label>
                                            <input type="radio" name="shipping" value="120">
                                            <span>ঢাকার বাইরে: <strong>১২০.০০ ৳</strong></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Total -->
                                <div class="yo-row total-row-bold">
                                    <span>Total</span>
                                    <span id="totalDisplay">৭১০.০০ ৳</span>
                                </div>
                            </div>

                            <!-- Payment -->
                            <div class="payment-box">
                                <div class="payment-box-header">Cash on delivery</div>
                                <div class="payment-box-body">Pay with cash upon delivery.</div>
                            </div>

                            <p class="privacy-note">Your personal data will be used to process your order, support your
                                experience throughout this website, and for other purposes described in our <a
                                    href="#">privacy policy</a>.</p>

                            <button class="order-button" id="placeOrderBtn" type="submit">
                                অর্ডার করুন <span id="btnTotal">{{ $page->button }}</span>
                            </button>
                        </div>
                    </div><!-- end order-summary -->
                </div><!-- end order-form-container -->
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="d-flex align-items-center justify-content-md-between gap-4 flex-wrap justify-content-center">
                <p>© 2026 FoodspecialMasala. All rights reserved</p>
                <div>
                    <a href="#">Privacy policy</a>
                    <a href="#">Terms of service</a>
                </div>
            </div>
        </div>
    </footer>
    {{-- @endforeach --}}
@endsection

@push('scripts')
{{-- <script>
    var products = @json($products->map(function($p){
        return [
            'name' => $p->name,
            'price' => $p->price,
            'img' => $p->product_image 
                ? Storage::disk('public')->url($p->product_image)
                : asset('assets/images/product.png'),
            'qty' => 1,
            'active' => false
        ];
    }));
</script> --}}

@endpush


