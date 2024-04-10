<footer>
   
    <script src="https://kit.fontawesome.com/8f90b118b8.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets') }}/js/tableexport.min.js"></script>

    <script>
        $(document).ready(function() {
            // Get the stored CSS preference from localStorage
            var storedPreference = localStorage.getItem("cssPreference");

            // Check if the checkbox is already checked based on the stored preference
            if (storedPreference && storedPreference.includes("light")) {
                $("#check").prop("checked", true);
                $("#transaction-light").attr("href", "/style/transaction-light.css");
            }

            // Handle the checkbox change event
            $("#check").change(function() {
                if ($(this).is(":checked")) {
                    $("#transaction-light").attr("href", "/style/transaction-light.css");
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", "/style/transaction-light.css");
                } else {
                    $("#transaction-light").attr("href", "/style/transaction.css");
                    // Remove the CSS preference from localStorage
                    localStorage.removeItem("cssPreference");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Get the stored CSS preference from localStorage
            var storedPreference = localStorage.getItem("cssPreference");

            // Check if the checkbox is already checked based on the stored preference
            if (storedPreference && storedPreference.includes("light")) {
                $("#check-two").prop("checked", true);
                $("#transaction-light").attr("href", "/style/transaction-light.css");
            }

            // Handle the checkbox change event
            $("#check-two").change(function() {
                if ($(this).is(":checked")) {
                    $("#transaction-light").attr("href", "/style/transaction-light.css");
                    // Store the CSS preference in localStorage
                    localStorage.setItem("cssPreference", "/style/transaction-light.css");
                } else {
                    $("#transaction-light").attr("href", "/style/transaction.css");
                    // Remove the CSS preference from localStorage
                    localStorage.removeItem("cssPreference");
                }


            });
        });
    </script>

    <script>
        // Get the button and date range elements
        const button = document.querySelector("#calendarButton");
        const dateRangeElement = document.querySelector("#dateRange");

        // Initialize Flatpickr date picker
        const dateRangePicker = flatpickr(dateRangeElement, {
            mode: "range",
            dateFormat: "m/d/Y",
            inline: true,
            onClose: function(selectedDates, dateStr, instance) {
                // Hide the calendar when it is closed
                instance.close();
            }
        });

        // Handle click event on the button to toggle the calendar visibility
        button.addEventListener("click", () => {
            dateRangePicker.toggle();
        });
    </script>


    <script>
        $(document).ready(function() {
            $("#addCashier").click(function(e) {
                e.preventDefault();
                $("#cashierForm").fadeIn();
            });

            $("#cashierCloseBtn").click(function() {
                $("#cashierForm").fadeOut();
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $("#transactionOption").click(function(e) {
                if (e.target.tagName !== 'DIV') return;
                $("#transactionOption").addClass("active");
                $("#cashierOption").removeClass("active");
                $("#transactionComponent").show();
                $("#cashierComponent").hide();
            });

            $("#cashierOption").click(function(e) {
                if (e.target.tagName !== 'DIV') return;
                $("#cashierOption").addClass("active");
                $("#transactionOption").removeClass("active");
                $("#cashierComponent").show();
                $("#transactionComponent").hide();
            });

            $(".component-option").click(function() {
                $(".component-option").removeClass("active");
                $(this).addClass("active");
            });

            $("#addCashier").click(function(e) {
                e.preventDefault();
                $("#cashierForm").fadeIn();
            });

            $("#cashierCloseBtn").click(function() {
                $("#cashierForm").fadeOut();
            });
        });
    </script>
    <script>
        function toggleCashierForm(formId) {
            const cashierForm = document.getElementById(formId);
            if (cashierForm.style.display === "none") {
                cashierForm.style.display = "block";
            } else {
                cashierForm.style.display = "none";
            }
        }

        function cancelCashierForm(formId, cashierId) {
            const cashierForm = document.getElementById(formId);
            cashierForm.style.display = "none";
        }
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

 {{-- <script src="js/app.js"></script>
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
          </script> --}}
</footer>


