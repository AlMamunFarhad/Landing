<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>মশলা</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">

    <!-- Style css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --bg: #f4f7ff;
            --card-bg: #ffffff;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --border: #e5e7eb;
        }

        body {
            background: var(--bg);
            font-family: 'Inter', sans-serif;
        }

        .page-container {
            max-width: 1150px;
            margin: 60px auto;
        }

        .custom-card {
            background: var(--card-bg);
            border-radius: 22px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-top {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 35px 40px;
            color: #fff;
        }

        .card-top h3 {
            font-weight: 600;
            margin: 0;
            letter-spacing: .5px;
        }

        .section {
            padding: 35px 40px;
            border-bottom: 1px solid var(--border);
        }

        .section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--primary);
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
            display: block;
        }

        .switch {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .switch input {
            width: 40px;
            height: 20px;
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            padding: 14px 40px;
            border-radius: 14px;
            font-weight: 600;
            color: white;
            transition: .3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(79, 70, 229, 0.35);
        }

        .image-preview {
            margin-top: 10px;
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 6px;
            max-height: 130px;
        }

        .small-text {
            font-size: 12px;
            color: var(--text-light);
        }

        .page-content {
            font-size: 16px;
            line-height: 1.8;
        }

        .page-content p {
            margin-bottom: 18px;
        }

        .page-content ul,
        .page-content ol {
            margin-bottom: 18px;
            padding-left: 20px;
        }

        .usage-content ul li div {
            line-height: 30px !important;
        }

        .benefits-list li div {
            line-height: 30px !important;
        }
    </style>
    @yield('styles')

</head>

<body>

    {{-- @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif --}}
    <!-- Global Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
        @if (session('success'))
            <div class="toast align-items-center text-bg-white border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-black me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>


    @yield('content')

    {{-- <textarea id="test"></textarea> --}}
    <!-- Footer -->


    <!-- Floating Buttons -->
    <div class="floating-buttons">
        <a href="https://wa.me/8801309568533" target="_blank" class="float-btn whatsapp" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="#order-sec-id" target="_blank" class="float-btn phone" title="Call Now">
            <i class="fas fa-phone-alt"></i>
        </a>
        <a href="https://m.me/yourpage" target="_blank" class="float-btn messenger" title="Messenger">
            <i class="fab fa-facebook-messenger"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
    <script>
        // $(function() {
        //     $('#test').summernote();
        // });

        $(document).ready(function() {
            $('#why_choose_description').summernote({
                height: 200
            });
            $('#why_trust_us_description').summernote({
                height: 200
            });
        });
    </script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('scripts')
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            toastElList.map(function(toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                })
                toast.show()
            })
        });

        // Smooth scroll animations
        $(document).ready(function() {
            // Fade in elements on scroll
            function checkScroll() {
                $('.fade-in').each(function() {
                    var elementTop = $(this).offset().top;
                    var elementBottom = elementTop + $(this).outerHeight();
                    var viewportTop = $(window).scrollTop();
                    var viewportBottom = viewportTop + $(window).height();

                    if (elementBottom > viewportTop && elementTop < viewportBottom) {
                        $(this).addClass('visible');
                    }
                });
            }

            // Check on page load
            checkScroll();

            // Check on scroll
            $(window).on('scroll', function() {
                checkScroll();
            });

            // Smooth scroll for anchor links
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 80
                    }, 1000);
                }
            });
        });



        // Call button click tracking
        $('.order-btn-id, .float-btn.phone').on('click', function() {
            console.log('Call button clicked');
        });

        // WhatsApp button click tracking
        $('.float-btn.whatsapp').on('click', function() {
            console.log('WhatsApp button clicked');
        });
    </script>

</body>

</html>
