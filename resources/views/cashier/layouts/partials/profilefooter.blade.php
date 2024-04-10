<footer>
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
</footer>
