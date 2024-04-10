<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href={{ url(asset('assets/new-css/index.css')) }}>
    <link rel="stylesheet" href={{ url(asset('assets/new-css/profile.css')) }}>
    <link rel="stylesheet" href={{ url(asset('assets/new-css/dropdown.css')) }}>
    <link rel="stylesheet" href={{ url(asset('assets/new-css/store.css')) }}>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>MTC</title>

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
    .main-sec{
        margin-top: 40px;
    }
    .Conatiner-2-passowrd {
        position: static;
    }
    .container-personal{
        padding: 10px 0px;
    }
    .nav-right a {
            text-decoration: none;
            /* Remove underline from links */
            display: inline-block;
            /* Make links behave like block elements */
            margin-right: 5px;
            transition: background-color 0.3s, transform 0.3s, opacity 0.3s;
            /* Add smooth transitions */
        }

        .nav-right a:hover {
            background-color: #2c3e50;
            /* Change background color on hover */
            opacity: 0.8;
            /* Reduce opacity on hover */
        }

        .nav-right a i {
            color: #ffffff;
            /* Default icon color */
        }

        .nav-right a:hover i {
            transform: scale(1.2);
            /* Increase icon size on hover */
        }

</style>

<body>
    <header class="header">
        <a href="/" class="logo">MTC</a>
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
                <a class="logo-text" href="{{route('dashboard')}}" style="text-decoration: none; color: white">MTC</a>
            </div>
            <div class="nav-right">
                <div class="toggle-switch">
                    <input type="checkbox" id="check" class="toggle" />
                    <label for="check"></label>
                </div>
                <a href="{{ url('/logout') }}"
                    style="background-color: #3498db; border-radius: 5px; padding: 8px; margin-right: 5px;">
                    <i class="fa fa-sign-out" style="color: #ffffff;"></i>
                </a>
                <a href="{{ url('/settings') }}"
                    style="background-color: #27ae60; border-radius: 5px; padding: 8px; margin-right: 5px;">
                    <i class="fa fa-gear" style="color: #ffffff;"></i>
                </a>
                <div class="menu-left-name" style="margin-top: 5px">
                    <p style="color: #3498db;">{{ ucwords(auth()->check() ? auth()->user()->name : 'John Leo') }}</p>
                    <p style="font-size: 9px; color: #fff; ">
                        {{ ucwords(auth()->check() ? auth()->user()->role : 'Admin') }}
                    </p>
                </div>
            </div>
        </nav>
    </header>



    <div class="background-container">
        <section class="hero-sec">
            <div style="z-index: 100; top: -20px; position: absolute; left: -40px">
                <p id="personalInfoHeading" class="Personal-info-section">Personal Information</p>
                <p id="securityHeading" class="security-info-section">Security</p>
                {{-- <p id="privateWalletHeading" class="Private-info-section">Private Wallets</p> --}}
            </div>
            <div class="main-sec" >
                {{-- <div class="container-profile">
                    <img src={{ url(asset('assets/images/profile-picture.png')) }} class="profile-img-icon">
                    <img src={{ url(asset('assets/images/second-picture.png')) }} class="side-img">
                    <p class="text">Click to upload</p>
                    <p class="text-2">Maximun image size 3MB</p>
                </div> --}}
                <div id="personalInfo" class="container-personal">
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
                        <form action={{route('update-admin')}} method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="container-profile" style="margin-bottom: 10px">
                                <input type="file" name="image" id="fileInput" style="display: none;">
                                <label for="fileInput" class="file-upload-label">
                                    <img src="{{ url(asset('assets/images/profile-picture.png')) }}"
                                        class="profile-img-icon">
                                    <img src="{{ url(asset('assets/images/second-picture.png')) }}" class="side-img">
                                    <p class="text">Click to upload</p>
                                    <p class="text-2">Maximum image size 3MB</p>
                                </label>
                            </div> --}}
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Enter Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="First name" value="{{$user->name}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter Email" value="{{$user->email}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Mobile Number</label>
                                        <input type="tel" name="contact" class="form-control"
                                            placeholder="Enter Mobile Number" value="{{$user->mobile}}" required>

                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success" value="Confirm">
                        </form>
                    </div>
                </div>

                <div id="security" class="Conatiner-2-passowrd" style="display: none;">
                    <form action={{ route('update-password') }} method="POST">
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

            <script>
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
            </script>

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
