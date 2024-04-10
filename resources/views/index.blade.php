<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link id="stylesheet" rel="stylesheet" href={{ url(asset('assets/css/style.css')) }} />
    <title>Dazypay</title>
</head>

<body>
    <header class="header">
        <a href="/" class="logo">Dazpay</a>
        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
        <div class="move-toggle">
            <input type="checkbox" id="check-two" class="toggle-two" />
            <label for="check-two"></label>
        </div>
        <ul class="menu">
            <li><a href="#">Market</a></li>
            <li><a href="#">Statistics</a></li>
            <li><a href="#">How it works</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </header>
    <header>
        <nav>
            <div class="flex-container">
                <div class="logo-text">Dazypay</div>
                <div class="menu-links">
                    <ul>
                        <li><a href="#">Market</a></li>
                        <li><a href="#">Statistics</a></li>
                        <li><a href="#">How it works</a></li>
                        <li><a href="#">About us</a></li>
                    </ul>
                </div>
                <div class="login-btn">
                    <div>
                        <input type="checkbox" id="check" class="toggle" />
                        <label for="check"></label>
                    </div>
                    <div><a href={{ url('/login') }}>Log in</a></div>
                </div>
            </div>
        </nav>
    </header>
    <div class="background-container">
        <section class="hero-sec">
            <div class="main-sec">
                <h1>Dazpaywallet</h1>
                <div class="sub-heading">
                    <p>
                        Simplify your crypto life:<br />access & manage your assets
                        anytime, anywhere
                    </p>
                </div>
            </div>
        </section>
        <section class="container section-sec">
            <div class="sec-row">
                <div class="col-1-of-2">
                    <h2>
                        <span class="sec-row-h">Crypto world.</span><br /><span
                            class="sec-row-sub-h">All-in-one-solution.</span>
                    </h2>
                </div>
                <div class="col-1-of-2">
                    <p class="sec-row-p">
                        with our user-friendly platform, you can easily buy,sell, and
                        store crypto currency securely and hassle-free. Say goodbye to
                        complicated interaces and hello to a seamless crypto experience
                        with Dazzpaywallet.
                    </p>
                </div>
            </div>
        </section>
    </div>
    <section class="stats">
        <div class="stats-grid container">
            <div class="stats-main-text">
                <p>
                    <span class="stats-number">562 M</span><br /><span class="stats-text">of active daily user</span>
                </p>
            </div>
            <div class="stats-main-text">
                <p>
                    <span class="stats-number">562 M</span><br /><span class="stats-text">of active daily user</span>
                </p>
            </div>
            <div class="stats-main-text">
                <p>
                    <span class="stats-number">562 M</span><br /><span class="stats-text">of active daily user</span>
                </p>
            </div>
            <div class="stats-main-text">
                <p>
                    <span class="stats-number">562 M</span><br /><span class="stats-text">of active daily user</span>
                </p>
            </div>
        </div>
    </section>
    <section class="sec-features container auto">
        <div class="d-flex-center key-sec">
            <h3>
                <span class="sec-features__heading">Key features</span><br /><span
                    class="sec-features__sub-heading">that set us apart</span>
            </h3>
        </div>
        <div class="d-flex-center mt-35">
            <div class="key-sec-text">
                <p>
                    Dazzpay is more than just a wallet - it's a comprehensive platform
                    with features<br />that are tailored to the need of cryptocurrency
                    enthusiets
                </p>
            </div>
        </div>
        <div class="key-features-cards d-grid mt-150 mb-120">
            <div class="features__cards column1">
                <img src="{{ asset('assets/images/Vector2.svg') }}" alt="" />
                <div class="cards-text">
                    <p>
                        <span class="card-primary-text">Secure Storage</span><br /><span
                            class="card-secondary-text">Sending & receiving cryptocurrency has never been easier. Make
                            transaction with just a few clicks.</span>
                    </p>
                </div>
                <div class="cards-btn">
                    <a href="#">Learn More</a>
                </div>
            </div>
            <div class="features__cards column2">
                <img src="{{ asset('assets/images/Vector2.svg') }}" alt="" />
                <div class="cards-text">
                    <p>
                        <span class="card-primary-text">Secure Storage</span><br /><span
                            class="card-secondary-text">Sending & receiving cryptocurrency has never been easier. Make
                            transaction with just a few clicks.</span>
                    </p>
                </div>
                <div class="cards-btn">
                    <a href="#">Learn More</a>
                </div>
            </div>
            <div class="features__cards column3">
                <img src="{{ asset('assets/images/Vector2.svg') }}" alt="" />
                <div class="cards-text">
                    <p>
                        <span class="card-primary-text">Secure Storage</span><br /><span
                            class="card-secondary-text">Sending & receiving cryptocurrency has never been easier. Make
                            transaction with just a few clicks.</span>
                    </p>
                </div>
                <div class="cards-btn">
                    <a href="#">Learn More</a>
                </div>
            </div>
        </div>
    </section>
    <section class="container auto section-third pt-35 mb-60">
        <div class="sec-row">
            <div class="col-1-of-2">
                <h1 class="section-third-h">Mega Offer</h1>
                <p class="section-third-p">
                    Customers have the opportunity to receive percentages.
                </p>
            </div>
            <div class="col-1-of-2 d-flex-center">
                <div class="box d-flex-center-horizontal">
                    <div class="box-img mb-120">
                        <img src="{{ asset('assets/images/Vector4.svg') }}" alt="" />
                    </div>
                    <p>Grab Your Special offer now</p>
                    <a href="#">Get Offer</a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-fourth container auto pt-50 mb-120">
        <img class="arrow-left" src="{{ asset('assets/images/arrow-right.svg') }}" alt="" />
        <h2 class="text-center">Review</h2>
        <div class="carousel reviews reviews-grid show-columns">
            <div class="review-grid-box">
                <div class="review-img">
                    <div class="review-img-inner">
                        <img src="{{ asset('assets/images/john-doe.jpg') }}" alt="" />
                        <p>John Leo</p>
                        <img src="{{ asset('assets/images/Vector5.svg') }}" alt=""
                            style="height: 8px" />
                    </div>
                    <p style="color: #c3c3c3; padding-left: 48px; font-size: 9px">
                        @johnleo
                    </p>
                </div>

                <p class="review-msg">Ooh Etherium is soO cool..</p>
                <p class="review-footer">
                    06:30 PM - Aug 16,2023 - <span>Twitter Web App</span>
                </p>
            </div>
            <div class="review-grid-box">
                <div class="review-img">
                    <div class="review-img-inner">
                        <img src="{{ asset('assets/images/john-doe.jpg') }}" alt="" />
                        <p>John Leo</p>
                        <img src="{{ asset('assets/images/Vector5.svg') }}" alt=""
                            style="height: 8px" />
                    </div>
                    <p style="color: #c3c3c3; padding-left: 48px; font-size: 9px">
                        @johnleo
                    </p>
                </div>
                <p class="review-msg">Ooh Etherium is soO cool..</p>
                <p class="review-footer">
                    06:30 PM - Aug 16,2023 - <span>Twitter Web App</span>
                </p>
            </div>

            <div class="review-grid-box">
                <div class="review-img">
                    <div class="review-img-inner">
                        <img src="{{ asset('assets/images/john-doe.jpg') }}" alt="" />
                        <p>John Leo</p>
                        <img rc="{{ asset('assets/images/Vector5.svg') }}" alt=""
                            style="height: 8px" />
                    </div>
                    <p style="color: #c3c3c3; padding-left: 48px; font-size: 9px">
                        @johnleo
                    </p>
                </div>
                <p class="review-msg">Ooh Etherium is soO cool..</p>
                <p class="review-footer">
                    06:30 PM - Aug 16,2023 - <span>Twitter Web App</span>
                </p>
            </div>
            <div class="review-grid-box">
                <div class="review-img">
                    <div class="review-img-inner">
                        <img src="{{ asset('assets/images/john-doe.jpg') }}" alt="" />
                        <p>John Leo</p>
                        <img rc="{{ asset('assets/images/Vector5.svg') }}" alt=""
                            style="height: 8px" />
                    </div>
                    <p style="color: #c3c3c3; padding-left: 48px; font-size: 9px">
                        @johnleo
                    </p>
                </div>
                <p class="review-msg">Ooh Etherium is soO cool..</p>
                <p class="review-footer">
                    06:30 PM - Aug 16,2023 - <span>Twitter Web App</span>
                </p>
            </div>
        </div>
        <img class="arrow-right" src="{{ asset('assets/images/arrow-left.svg') }}" alt="" />
    </section>
    <section class="container section-five auto">
        <div class="sec-row">
            <div class="col-1-of-2">
                <div class="footer-img-box">
                    <img src="{{ asset('assets/images/iPhone 14 Pro Max - 3.jpg') }}" alt="" />
                </div>
            </div>
            <div class="col-1-of-2">
                <h2>Download the App Today</h2>
                <p>
                    With our platform, you can make your first move in less than 60
                    seconds! Don't waste any more time and start trading journey today.
                </p>
                <div class="buttons">
                    <div class="button-one">
                        <img src="{{ asset('assets/images/play-logo.svg') }}" alt="" />
                        <a href="#"><span class="text-upper">Get it on</span><span class="text-bottom">Google
                                Play</span></a>
                    </div>
                    <div class="button-two">
                        <img src="{{ asset('assets/images/apple-logo.svg') }}" alt="" />
                        <a href="#"><span class="text-upper">Download on</span><span class="text-bottom">Apple
                                Store</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="container auto">
        <div class="footer-top">
            <p class="footer-logo">Dazpay</p>
            <div class="icon-box">
                <img src="{{ asset('assets/images/Vector.svg') }}" alt="" />
                <img src="{{ asset('assets/images//twitter.svg') }}" alt="" />
                <img src="{{ asset('assets/images/Vector (1).svg') }}" alt="" />
                <img src="{{ asset('assets/images/Vector (2).svg') }}" alt="" />
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-links">
                <ul>
                    <li>Company</li>
                    <li>Resources</li>
                    <li>Legal</li>
                    <li>Services</li>
                </ul>
            </div>
            <div class="copyright">
                <p>Copyright</p>
                <img src="{{ asset('assets/images/copyright.svg') }}" alt="" />
                <p>Dazpay, 2023</p>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/8f90b118b8.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script>
            $(document).ready(function() {
                // Check if the checkbox is checked or unchecked
                var isLightMode = $("#check").is(":checked");

                // Apply the appropriate CSS file based on the checkbox state
                if (isLightMode) {
                    $("#stylesheet").attr("href", "{{ asset('assets/css/light-css.css') }}");
                } else {
                    $("#stylesheet").attr("href", "{{ asset('assets/css/style.css') }}");
                }

                // Handle the checkbox change event
                $("#check").change(function() {
                    isLightMode = $(this).is(":checked");

                    // Apply the appropriate CSS file based on the checkbox state
                    if (isLightMode) {
                        $("#stylesheet").attr("href", "{{ asset('assets/css/light-css.css') }}");
                    } else {
                        $("#stylesheet").attr("href", "{{ asset('assets/css/style.css') }}");
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Check if the checkbox is checked or unchecked
                var isLightModeS = $("#check-two").is(":checked");

                // Apply the appropriate CSS file based on the checkbox state
                if (isLightModeS) {
                    $("#stylesheet").attr("href", "{{ asset('assets/css/light-css.css') }}");
                } else {
                    $("#stylesheet").attr("href", "{{ asset('assets/css/style.css') }}");
                }

                // Handle the checkbox change event
                $("#check-two").change(function() {
                    isLightModeS = $(this).is(":checked");

                    // Apply the appropriate CSS file based on the checkbox state
                    if (isLightModeS) {
                        $("#stylesheet").attr("href", "{{ asset('assets/css/light-css.css') }}");
                    } else {
                        $("#stylesheet").attr("href", "{{ asset('assets/css/style.css') }}");
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                const reviewsCarousel = $(".carousel.reviews");
                const reviewBoxes = $(".review-grid-box");
                const leftArrow = $(".arrow-left");
                const rightArrow = $(".arrow-right");
                const showColumnsClass = "show-columns";
                const visibleColumns = 3;

                let isDragStartReview = false;
                let isDraggingReview = false;
                let prevPageXReview;
                let positionDiffReview;

                const dragStartReview = (e) => {
                    isDragStartReview = true;
                    prevPageXReview = e.pageX || e.originalEvent.touches[0].pageX;
                };

                const draggingReview = (e) => {
                    if (!isDragStartReview) return;
                    e.preventDefault();
                    isDraggingReview = true;
                    const pageX = e.pageX || e.originalEvent.touches[0].pageX;
                    const diffX = prevPageXReview - pageX;
                    prevPageXReview = pageX;
                    reviewsCarousel.scrollLeft(reviewsCarousel.scrollLeft() + diffX);
                    positionDiffReview = diffX;
                };

                const dragEndReview = () => {
                    if (!isDraggingReview) return;
                    isDragStartReview = false;
                    isDraggingReview = false;
                };

                leftArrow.on("click", function() {
                    const firstHiddenReviewBox = reviewBoxes.filter(":hidden").first();
                    if (firstHiddenReviewBox.length === 0) return;

                    const firstReviewBox = reviewBoxes.first();
                    const firstReviewBoxWidth = firstReviewBox.outerWidth();
                    const scrollLeftValue =
                        reviewsCarousel.scrollLeft() - firstReviewBoxWidth;
                    reviewsCarousel.animate({
                            scrollLeft: scrollLeftValue
                        },
                        300,
                        function() {
                            firstHiddenReviewBox.show().addClass("animated-slide");
                            reviewBoxes.last().hide().removeClass("animated-slide");
                        }
                    );
                });

                rightArrow.on("click", function() {
                    const lastVisibleReviewBox = reviewBoxes.filter(":visible").last();
                    const nextReviewBox = lastVisibleReviewBox.next();
                    if (nextReviewBox.length === 0) return;

                    const firstReviewBox = reviewBoxes.first();
                    const firstReviewBoxWidth = firstReviewBox.outerWidth();
                    const scrollLeftValue =
                        reviewsCarousel.scrollLeft() + firstReviewBoxWidth;
                    reviewsCarousel.animate({
                            scrollLeft: scrollLeftValue
                        },
                        300,
                        function() {
                            nextReviewBox.show().addClass("animated-slide");
                            reviewBoxes.first().hide().removeClass("animated-slide");
                        }
                    );
                });

                reviewsCarousel.on("mousedown", dragStartReview);
                reviewsCarousel.on("touchstart", dragStartReview);
                $(window).on("mousemove", draggingReview);
                $(window).on("touchmove", draggingReview);
                $(window).on("mouseup", dragEndReview);
                $(window).on("touchend", dragEndReview);

                function updateCarouselVisibility() {
                    const scrollLeft = reviewsCarousel.scrollLeft();
                    const containerWidth = reviewsCarousel.outerWidth();
                    const reviewBoxWidth = reviewBoxes.first().outerWidth();
                    const totalColumns = Math.ceil(
                        reviewsCarousel.outerWidth() / reviewBoxWidth
                    );
                    const visibleColumns = Math.floor(containerWidth / reviewBoxWidth);
                    const hiddenColumns = totalColumns - visibleColumns;

                    if (scrollLeft === 0) {
                        leftArrow.addClass("hidden");
                    } else {
                        leftArrow.removeClass("hidden");
                    }

                    if (scrollLeft + containerWidth >= totalColumns * reviewBoxWidth) {
                        rightArrow.addClass("hidden");
                    } else {
                        rightArrow.removeClass("hidden");
                    }

                    reviewBoxes.removeClass("animated-slide");
                    reviewBoxes
                        .hide()
                        .slice(0, visibleColumns)
                        .show()
                        .addClass("animated-slide");
                }

                updateCarouselVisibility();
                $(window).on("resize", updateCarouselVisibility);
            });
        </script>
    </footer>
</body>

</html>
