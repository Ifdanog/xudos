<footer>
    <script
      src="https://kit.fontawesome.com/8f90b118b8.js"
      crossorigin="anonymous"
    ></script>
    <script src="./js/app.js"></script>
    <script>
      $(document).ready(function () {
        // Get the stored CSS preference from localStorage
        var storedPreference = localStorage.getItem("cssPreference");

        // Check if the checkbox is already checked based on the stored preference
        if (storedPreference && storedPreference.includes("light")) {
          $("#check").prop("checked", true);
          $("#stores-stylesheet").attr("href", "css/stores-light.css");
        }

        // Handle the checkbox change event
        $("#check").change(function () {
          if ($(this).is(":checked")) {
            $("#stores-stylesheet").attr("href", "css/stores-light.css");
            // Store the CSS preference in localStorage
            localStorage.setItem("cssPreference", "css/stores-light.css");
          } else {
            $("#stores-stylesheet").attr("href", "css/stores.css");
            // Remove the CSS preference from localStorage
            localStorage.removeItem("cssPreference");
          }
        });
      });
    </script>
          <script>
            $(document).ready(function () {
              // Get the stored CSS preference from localStorage
              var storedPreference = localStorage.getItem("cssPreference");

              // Check if the checkbox is already checked based on the stored preference
              if (storedPreference && storedPreference.includes("light")) {
                $("#check-two").prop("checked", true);
                $("#stores-stylesheet").attr("href", "css/stores-light.css");
              }

              // Handle the checkbox change event
              $("#check-two").change(function () {
                if ($(this).is(":checked")) {
                  $("#stores-stylesheet").attr("href", "css/stores-light.css");
                  // Store the CSS preference in localStorage
                  localStorage.setItem("cssPreference", "css/stores-light.css");
                } else {
                  $("#stores-stylesheet").attr("href", "css/stores.css");
                  // Remove the CSS preference from localStorage
                  localStorage.removeItem("cssPreference");
                }
              });
            });
          </script>
  </footer>
