 // Spices Swiper Slider — no nav, no dots, auto-loop, responsive
const spicesSwiper = new Swiper('.spices-swiper', {
    loop: true,
    autoplay: {
        delay: 0,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },
    speed: 3000,
    freeMode: true,
    grabCursor: true,
    slidesPerView: 2,
    spaceBetween: 16,
    breakpoints: {
        480:  { slidesPerView: 3, spaceBetween: 16 },
        640:  { slidesPerView: 4, spaceBetween: 18 },
        900:  { slidesPerView: 7, spaceBetween: 20 },
        1100: { slidesPerView: 8, spaceBetween: 20 },
        1365: { slidesPerView: 10, spaceBetween: 20 },
    },
});





// ===== Interactive Order Form =====
$(document).ready(function () {

    // Product data
    var products = [
        { name: 'শাহী গরম মশলা (২০০ গ্রাম)', price: 650,  img: 'assets/images/product.png', qty: 1, active: true  },
        { name: 'শাহী গরম মশলা (৫০০ গ্রাম)', price: 1500, img: 'assets/images/product.png', qty: 1, active: false }
    ];

    // Bengali number formatter
    function toBn(n) {
        var bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return n.toFixed(2).replace(/\d/g, d => bn[d]);
    }

    function getShipping() {
        return parseInt($('input[name="shipping"]:checked').val()) || 60;
    }

    function calcSubtotal() {
        var sub = 0;
        products.forEach(function (p) {
            if (p.active) sub += p.price * p.qty;
        });
        return sub;
    }

    function updateOrderTable() {
        var sub = calcSubtotal();
        var ship = getShipping();
        var total = sub + ship;

        // Table body
        var rows = '';
        products.forEach(function (p) {
            if (p.active) {
                rows += '<tr>' +
                    '<td><img src="' + p.img + '" class="yo-prod-img" alt=""><span class="yo-prod-name">' + p.name + '</span></td>' +
                    '<td>× ' + p.qty + '&nbsp;&nbsp;' + toBn(p.price * p.qty) + ' ৳</td>' +
                '</tr>';
            }
        });
        if (!rows) rows = '<tr><td colspan="2" style="color:#aaa;padding:8px 0;">কোনো পণ্য নির্বাচিত হয়নি</td></tr>';
        $('#orderTableBody').html(rows);

        // Subtotal / Total displays
        $('#subtotalDisplay').text(toBn(sub) + ' ৳');
        $('#totalDisplay').text(toBn(total) + ' ৳');
        $('#btnTotal').text(toBn(total) + ' ৳');
    }

    // === Product card click (radio select) ===
    $(document).on('click', '.select-product-card', function (e) {
        // Don't toggle if clicking qty buttons
        if ($(e.target).hasClass('qty-btn') || $(e.target).closest('.qty-btn').length) return;

        var idx = $(this).data('product');
        products[idx].active = !products[idx].active;
        $(this).toggleClass('active', products[idx].active);
        updateOrderTable();
    });

    // === Quantity stepper ===
    $(document).on('click', '.qty-minus', function (e) {
        e.stopPropagation();
        var card = $(this).closest('.select-product-card');
        var idx  = card.data('product');
        if (products[idx].qty > 1) {
            products[idx].qty--;
            card.find('.qty-val').text(products[idx].qty);
            card.find('.qty-display').text(products[idx].qty);
            updateOrderTable();
        }
    });

    $(document).on('click', '.qty-plus', function (e) {
        e.stopPropagation();
        var card = $(this).closest('.select-product-card');
        var idx  = card.data('product');
        products[idx].qty++;
        card.find('.qty-val').text(products[idx].qty);
        card.find('.qty-display').text(products[idx].qty);
        updateOrderTable();
    });

    // === Shipping radio change ===
    $(document).on('change', 'input[name="shipping"]', function () {
        updateOrderTable();
    });



    // Initial render
    updateOrderTable();
});


