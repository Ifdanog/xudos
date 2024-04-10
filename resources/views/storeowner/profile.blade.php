{{-- @extends('storeowner.layouts.app')
@section('content')
    <div class="background-container">
        <section class="hero-sec">
            <div class="main-sec">


                <div class="container-profile" style="display: flex; justify-content: space-around;  height: 200px">
                    @if ($userId->image == null)
                        <img id="proImg" src="{{ asset('assets/images/face.jpeg') }}"
                            alt=""style="width:155px; height:165px; border:1px solid #ccc;">
                    @else
                        <img id="proImg" src="{{ $url }}" alt=""
                            style="width:155px; height:165px; border:1px solid #ccc; margin-top: 15px;
                    position: fixed;">
                    @endif
                    <button id="profileImage" class="text" style="margin: auto 0px">Click to upload</button>

                </div>

                <div class="container">
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
                        <form action="{{ route('storeowner.update-profile') }}" id="profile-form" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="id" value="{{ $userId->id }}">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Full Name</label>
                                        <input type="text" name="name" value="{{ old('name', $userId->name) }}"
                                            class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email', $userId->email) }}"
                                            class="form-control" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Mobile Number</label>
                                        <input type="text" name="contact" value="{{ old('contact', $userId->contact) }}"
                                            class="form-control" value="" required>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input id="profileIMG" type="file" name="image" style="opacity: 0;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Confirm">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="">

                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information"
                        style="
                    border-radius: 10px;
                    height: 264px;
                    margin-top: 211px;
                    background: papayawhip;
                    background: #13171C;
                    width: 498px;
                    margin-left: 6px;">
                        <form action="{{ route('storeowner.update-password') }}" id="password-form" method="POST">

                            @csrf
                            <input type="hidden" name="id" value="{{ $userId->id }}">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div style=" margin-top = 3px;">
                                        <label class="profile_text">Old Password</label>
                                        <input type="password" name="old_password" class="form-input" value=""
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div style=" margin-top = 3px;">
                                        <label class="profile_text">Create Password</label>
                                        <input type="password" name="password" class="form-input" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div style="margin-top = 3px;">
                                        <label class="profile_text">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-input" value=""
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
                                    <div class="form-group">
                                        <input type="submit" class="button-update btn-success" value="Update">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>


                </div>

            </div>
        </section>
    </div> --}}

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href={{ url(asset('assets/new-css/index.css')) }}>
    <link rel="stylesheet" href={{ url(asset('assets/new-css/profile.css')) }}>
    <link rel="stylesheet" href={{ url(asset('assets/new-css/dropdown.css')) }}>
    <link rel="stylesheet" href={{ url(asset('assets/new-css/store.css')) }}>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>Dazypay</title>

    <style>
        .active-heading {
            color: blue;
            /* Change this to the desired color */
        }
    </style>
</head>
<style>
    .dropdown {
        position: relative;
        display: inline-block;
        margin-left: 20px
    }

    .drop-a:hover {
        color: inherit;
    }

    .dropdown-btn {
        background-color: transparent;
        color: white;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        font-family: 'Montserrat', sans-serif !important;
        font-size: 12px !important;
        font-weight: 500;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: black;
        min-width: 160px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        z-index: 100;
        overflow-y: scroll;
    }

    .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #333333;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

<body>
    <header class="header">
        <a href={{ route('storeowner.store-dashboard') }} class="logo">Dazpay</a>
        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
        <div class="move-toggle">
            <input type="checkbox" id="check-two" class="toggle-two" />
            <label for="check-two"></label>
        </div>
        <ul class="menu">
            <li><a href={{ url('/dashboard') }}>Dashboard</a></li>
            <li><a href={{ url('/add') }}>Create Stores / Cashiers</a></li>
            <div class="dropdown">
                <a style="text-decoration: none; cursor: pointer; font-weight: 500; color: #fff"
                    class="">Management</a>
                <div class="dropdown-content">
                    <a href={{ url('cashiers') }}>Cashier</a>
                    <a href={{ url('stores') }}>Stores</a>
                </div>
            </div>
            <li><a href={{ url('/transactions') }}>Transactions</a></li>
        </ul>
    </header>
    <header class="container-1">
        <nav>
            <div class="nav-left">
                <a class="logo-text" href="{{ route('storeowner.store-dashboard') }}"
                    style="text-decoration: none; color: white">Dazpay</a>
            </div>
            <div class="nav-right">
                <div class="toggle-switch">
                    <input type="checkbox" id="check" class="toggle" />
                    <label for="check"></label>
                </div>
                {{-- <a href={{ url('/logout') }}><i class="fa fa-sign-out" style="color: #ffffff"></i></a>
                <a href={{ url('/settings') }}><i class="fa fa-gear" style="color: #ffffff"></i></a> --}}
                <div class="menu-left-name">
                    <p>{{ ucwords(auth()->check() ? auth()->user()->name : 'John Leo') }}</p>
                    <p style="font-size: 9px; color: #fff">
                        {{ ucwords(auth()->check() ? auth()->user()->role : 'Admin') }}</p>
                </div>
            </div>
        </nav>
    </header>



    <div class="background-container">
        <section class="hero-sec">
            <div style="z-index: 100; top: -20px; position: absolute; left: -110px">
                <p id="personalInfoHeading" class="Personal-info-section active-heading">Personal Information</p>
                <p id="securityHeading" class="security-info-section">Security</p>
                <p id="privateWalletHeading" class="Private-info-section">Private Wallets</p>
            </div>
            <div class="main-sec" style="margin-top: 40px">
                <div id="personalInfo" class="container-personal">
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
                        <form action="{{ route('storeowner.update-profile') }}" id="profile-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $userId->id }}">
                            <div class="container-profile" style="margin-bottom: 10px">
                                <input type="file" name="image" id="fileInput" style="display: none;">
                                <label for="fileInput" class="file-upload-label">
                                    @if ($userId->image == null)
                                        <img src="{{ url(asset('assets/images/profile-picture.png')) }}"
                                            class="profile-img-icon">
                                    @else
                                        <img src="{{ url(asset('assets/' . $userId->image)) }}"
                                            class="profile-img-icon">
                                        <img src="{{ url(asset('assets/images/second-picture.png')) }}"
                                            class="side-img">
                                    @endif
                                    <p class="text">Click to upload</p>
                                    <p class="text-2">Maximum image size 3MB</p>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Enter Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="First name" value="{{ $userId->name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter Email" value="{{ $userId->email }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Mobile Number</label>
                                        <input type="tel" name="contact" class="form-control"
                                            placeholder="Enter Mobile Number" value="{{ $userId->mobile }}" required>

                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success" value="Confirm">
                        </form>
                    </div>
                </div>

                <div id="security" class="Conatiner-2-passowrd" style="display: none;">
                    <form action="{{ route('storeowner.update-password') }}" id="password-form" method="POST">
                        <input type="hidden" name="id" value="{{ $userId->id }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="profile_details_text-2">Enter Your Last Password</label>
                                    <input type="text" name="old_password" class="form-control-2"
                                        placeholder="*********" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="profile_details_text-2">Create Password</label>
                                    <input type="text" name="password" class="form-control-2"
                                        placeholder="*********" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="profile_details_text-2">Confirm Password</label>
                                    <input type="text" name="confirm_password" class="form-control-2"
                                        placeholder="*********" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
                                <div class="form-group">
                                    <input type="submit" class="btn-update-pass" value="Update Password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="privateWallet" class="Conatiner-3-tetraportion" style="display: none;">
                    <form action={{ route('storeowner.add-store-wallets') }} method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="profile_details_text">BSC(USDT)</label>
                                    <input type="text" name="bsc_wallet" class="form-control"
                                        value="{{ isset($wallets[0]->wallet) ? $wallets[0]->wallet : '' }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="profile_details_text">TRON(USDT)</label>
                                    <input type="text" name="tether_wallet" class="form-control"
                                        value="{{ isset($wallets[1]->wallet) ? $wallets[1]->wallet : '' }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="profile_details_text">SOLANA(USDT)</label>
                                    <input type="text" name="solana_wallet" class="form-control"
                                        value="{{ isset($wallets[2]->wallet) ? $wallets[2]->wallet : '' }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">

                                <p class="Note-paragrph-text">Note: Please be aware that the company is not responsible
                                    for any issues
                                    resulting from this change. Please check carefully before proceeding. The amount
                                    withdrawal to these addresses aren’t refundable.</p>
                                <div class="form-group">
                                    <input type="submit" class="btn-only-update" value="Update">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>



            </div>



            <script src="https://kit.fontawesome.com/8f90b118b8.js" crossorigin="anonymous"></script>
            <script src="js/app.js"></script>
            <script>
                $(document).ready(function() {
                    // Check if the checkbox is checked or unchecked
                    var isLightMode = $("#check").is(":checked");

                    // Apply the appropriate CSS file based on the checkbox state
                    if (isLightMode) {
                        $("#stylesheet").attr("href", "css/light-css.css");
                    } else {
                        $("#stylesheet").attr("href", "css/style.css");
                    }

                    // Handle the checkbox change event
                    $("#check").change(function() {
                        isLightMode = $(this).is(":checked");

                        // Apply the appropriate CSS file based on the checkbox state
                        if (isLightMode) {
                            $("#stylesheet").attr("href", "css/light-css.css");
                        } else {
                            $("#stylesheet").attr("href", "css/style.css");
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
                        $("#stylesheet").attr("href", "css/light-css.css");
                    } else {
                        $("#stylesheet").attr("href", "css/style.css");
                    }

                    // Handle the checkbox change event
                    $("#check-two").change(function() {
                        isLightModeS = $(this).is(":checked");

                        // Apply the appropriate CSS file based on the checkbox state
                        if (isLightModeS) {
                            $("#stylesheet").attr("href", "css/light-css.css");
                        } else {
                            $("#stylesheet").attr("href", "css/style.css");
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

            {{-- <script>
                // Wait for the DOM to load
                document.addEventListener('DOMContentLoaded', function() {
                    // Get the dropdown menu element
                    var dropdownMenu = document.getElementById('dropdownMenu');

                    // Hide the dropdown menu by default
                    dropdownMenu.style.display = 'none';

                    // Toggle the dropdown menu when the profile image is clicked
                    function toggleDropdownMenu() {
                        dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
                    }

                    // Attach the toggleDropdownMenu function to the profile image click event
                    var profileImage = document.querySelector('.menu-left-img img');
                    profileImage.addEventListener('click', toggleDropdownMenu);
                });
            </script> --}}

            <!-- Existing code -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const personalInfoHeading = document.getElementById('personalInfoHeading');
                    const securityHeading = document.getElementById('securityHeading');
                    const privateWalletHeading = document.getElementById('privateWalletHeading');

                    const personalInfoContainer = document.getElementById('personalInfo');
                    const securityContainer = document.getElementById('security');
                    const privateWalletContainer = document.getElementById('privateWallet');

                    // Select the container-profile element
                    const containerProfile = document.querySelector('.container-profile');

                    // Set the "Personal Information" section to be initially displayed
                    personalInfoContainer.style.display = 'block';

                    // Hide the "Security" and "Private Wallet" sections
                    securityContainer.style.display = 'none';
                    privateWalletContainer.style.display = 'none';

                    // Add click event listeners for section headings
                    personalInfoHeading.addEventListener('click', () => {
                        personalInfoContainer.style.display = 'block';
                        securityContainer.style.display = 'none';
                        privateWalletContainer.style.display = 'none';

                        // Only show container-profile when in "Personal Information" section
                        containerProfile.style.display = 'block';

                        // Add the active class to the clicked heading
                        personalInfoHeading.classList.add('active-heading');
                        // Remove the active class from other headings
                        securityHeading.classList.remove('active-heading');
                        privateWalletHeading.classList.remove('active-heading');
                    });

                    securityHeading.addEventListener('click', () => {
                        personalInfoContainer.style.display = 'none';
                        securityContainer.style.display = 'block';
                        privateWalletContainer.style.display = 'none';

                        // Hide container-profile in "Security" section
                        containerProfile.style.display = 'none';

                        // Add the active class to the clicked heading
                        securityHeading.classList.add('active-heading');
                        // Remove the active class from other headings
                        personalInfoHeading.classList.remove('active-heading');
                        privateWalletHeading.classList.remove('active-heading');
                    });

                    privateWalletHeading.addEventListener('click', () => {
                        personalInfoContainer.style.display = 'none';
                        securityContainer.style.display = 'none';
                        privateWalletContainer.style.display = 'block';

                        // Hide container-profile in "Private Wallet" section
                        containerProfile.style.display = 'none';

                        // Add the active class to the clicked heading
                        privateWalletHeading.classList.add('active-heading');
                        // Remove the active class from other headings
                        personalInfoHeading.classList.remove('active-heading');
                        securityHeading.classList.remove('active-heading');
                    });

                    // Additional JavaScript code for your functionality
                    // ...
                });
            </script>
            <script>
                const fileInput = document.getElementById("fileInput");
                const fileUploadLabel = document.querySelector(".file-upload-label");

                fileUploadLabel.addEventListener("click", () => {
                    fileInput.click();
                });
            </script>

            <!-- Existing code -->



            </footer>
</body>

</html>
