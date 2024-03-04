$('.article-slide-horizontal').slick({
    dots: false,
    infinite: true,
    speed: 800,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: false,
    prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
    nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
    responsive: [{
    breakpoint: 1200,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1
    }
    }, {
    breakpoint: 992,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1
    }
    }, {
    breakpoint: 768,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
    }
    } // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
}); //====== Magnific Popup

$('.article-slide-vertical').slick({
dots: false,
infinite: true,
speed: 800,
vertical: true,
slidesToShow: 3,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 5000,
arrows: false,
prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
responsive: [{
    breakpoint: 1200,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1
    }
}, {
    breakpoint: 992,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1
    }
}, {
    breakpoint: 768,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
    }
} // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
]
});

$('.course-slide').slick({
    dots: false,
    infinite: true,
    speed: 800,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: true,
    prevArrow: '<button class="px-3 py-2 bg-etudes-blue text-white rounded hover:bg-etudes-orange duration-300 slick-arrow-left"><i class="icofont-rounded-left"></i></button>',
    nextArrow: '<button class="px-3 py-2 bg-etudes-blue text-white rounded hover:bg-etudes-orange duration-300 slick-arrow-right"><i class="icofont-rounded-right"></i></button>',
    responsive: [{
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
      }
    } // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});

$('.online-slide').slick({
    dots: false,
    infinite: true,
    speed: 800,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: false,
    responsive: [{
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
      }
    } // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});

$('.subscription-certifications-slide').slick({
    dots: false,
    infinite: true,
    speed: 600,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    arrows: false,
    responsive: [{
      breakpoint: 1200,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
      }
    } // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});
