<footer class="footer">
  <div class="container-fluid">
    <div class="copyright">
      ©
      <script>
        document.write(new Date().getFullYear())
      </script> developed by
      <a href="javascript:void(0)" target="_blank">thernloven</a>
    </div>
  </div>
</footer>
</div>
</div>
<div class="fixed-plugin">
  <div class="dropdown show-dropdown">
    <a href="#" data-toggle="dropdown">
      <i class="fa fa-cog fa-2x"> </i>
    </a>
    <ul class="dropdown-menu">
      <!-- <li class="header-title"> Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors text-center">
              <span class="badge filter badge-primary active" data-color="primary"></span>
              <span class="badge filter badge-info" data-color="blue"></span>
              <span class="badge filter badge-success" data-color="green"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li> -->
      <li class="adjustments-line text-center color-change">
        <span class="color-label">LIGHT MODE</span>
        <span class="badge light-badge mr-2"></span>
        <span class="badge dark-badge ml-2"></span>
        <span class="color-label">DARK MODE</span>
      </li>
    </ul>
  </div>
</div>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/perfect-scrollbar.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/scripts.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="assets/demo/demo.js"></script> -->
<script src="assets/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>


<script>
  $(document).ready(function() {
    // Set timeout duration (in milliseconds)
    var timeoutInMilliseconds = 900000; // 15 minutes 900000

    // Function to redirect to logout.php
    function redirectLogout() {
      window.location.href = '../../includes/logout.php';
    }

    // Function to set the activity timeout
    function setActivityTimeout() {
      // Clear the existing timeout (if any)
      if (window.activityTimeout) {
        clearTimeout(window.activityTimeout);
      }

      // Set a new timeout
      window.activityTimeout = setTimeout(redirectLogout, timeoutInMilliseconds);
    }

    // Function to set up event listeners for activity
    function setupActivityListeners() {
      // Set event listeners for all elements on the page
      $(document).on('click keydown mousemove scroll', setActivityTimeout);
    }

    // Call the function to set up activity event listeners when the page loads
    setupActivityListeners();
  });
</script>

<?php if (isset($success)) { ?>
  <script>
    $(document).ready(function() {
      $('#successModalKids').modal('show');
    });
  </script>
<?php } ?>

<?php if (isset($pass_modal)) { ?>
  <script>
    $(document).ready(function() {
      $('#passModal').modal('show');
    });
  </script>
<?php } ?>

<!-- Initialize tooltips -->
<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  });
</script>
<script>
  $(document).ready(function() {
    $().ready(function() {
      $sidebar = $('.sidebar');
      $navbar = $('.navbar');
      $main_panel = $('.main-panel');

      $full_page = $('.full-page');

      $sidebar_responsive = $('body > .navbar-collapse');
      sidebar_mini_active = true;
      white_color = false;

      window_width = $(window).width();

      fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



      $('.fixed-plugin a').click(function(event) {
        if ($(this).hasClass('switch-trigger')) {
          if (event.stopPropagation) {
            event.stopPropagation();
          } else if (window.event) {
            window.event.cancelBubble = true;
          }
        }
      });

      $('.fixed-plugin .background-color span').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
          $sidebar.attr('data', new_color);
        }

        if ($main_panel.length != 0) {
          $main_panel.attr('data', new_color);
        }

        if ($full_page.length != 0) {
          $full_page.attr('filter-color', new_color);
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.attr('data', new_color);
        }
      });

      $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
        var $btn = $(this);

        if (sidebar_mini_active == true) {
          $('body').removeClass('sidebar-mini');
          sidebar_mini_active = false;
          blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
        } else {
          $('body').addClass('sidebar-mini');
          sidebar_mini_active = true;
          blackDashboard.showSidebarMessage('Sidebar mini activated...');
        }

        // we simulate the window Resize so the charts will get updated in realtime.
        var simulateWindowResize = setInterval(function() {
          window.dispatchEvent(new Event('resize'));
        }, 180);

        // we stop the simulation of Window Resize after the animations are completed
        setTimeout(function() {
          clearInterval(simulateWindowResize);
        }, 1000);
      });

      $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
        var $btn = $(this);

        if (white_color == true) {

          $('body').addClass('change-background');
          setTimeout(function() {
            $('body').removeClass('change-background');
            $('body').removeClass('white-content');
          }, 900);
          white_color = false;
        } else {

          $('body').addClass('change-background');
          setTimeout(function() {
            $('body').removeClass('change-background');
            $('body').addClass('white-content');
          }, 900);

          white_color = true;
        }


      });

      $('.light-badge').click(function() {
        $('body').addClass('white-content');
      });

      $('.dark-badge').click(function() {
        $('body').removeClass('white-content');
      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    demo.initDashboardPageCharts("1");
    $('input[type=radio][name=options]').change(function() {
      var selectedValue = $('input[type=radio][name=options]:checked').val();
      demo.initDashboardPageCharts(selectedValue);
    });

  });
</script>

<script src="//code.tidio.co/cbe0s02d74bhkvjfagrlculfyt01g7fv.js" async></script>

<script>
  function previewFile(event) {
    var preview = document.getElementById('previewImage');
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
      preview.src = reader.result;
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = '../admin/assets/img/avatars/default-avatar.png'; // Path to your default image
    }
  }
</script>

<script>
  // Get the radio buttons and file input elements
  const avatarRadios = document.querySelectorAll('input[type="radio"][name="img"]');
  const customImgInput = document.querySelector('input[type="file"][name="img"]');

  // Add event listener to the custom image input
  if (addEventListener) {
    customImgInput?.addEventListener('change', function() {
      // Deselect all the avatar radios
      avatarRadios.forEach(radio => {
        radio.checked = false;
      });
    });
  }

  // Add event listeners to the avatar radios
  if (avatarRadios) {
    avatarRadios.forEach(radio => {
      radio.addEventListener('change', function() {
        // Remove the selected file from the custom image input
        customImgInput.src = null;
      });
    });
  }
</script>

<script>
  $(document).ready(function() {

    $('#generateButton').click(function() {

      const today = new Date();

      // Tambahkan satu hari
      const tomorrow = new Date(today);
      tomorrow.setDate(today.getDate() + 1);

      // Format tanggal ke "Y-m-d H:i:s"
      const formattedDate = tomorrow.getFullYear() + "-" +
        ("0" + (tomorrow.getMonth() + 1)).slice(-2) + "-" +
        ("0" + tomorrow.getDate()).slice(-2) + " " +
        ("0" + tomorrow.getHours()).slice(-2) + ":" +
        ("0" + tomorrow.getMinutes()).slice(-2) + ":" +
        ("0" + tomorrow.getSeconds()).slice(-2);

      const url = '<?= $_SESSION['username'] ?>' + formattedDate;
      console.log(url);
      const hash = CryptoJS.MD5(url).toString();
      $('#url').val("<?= getServerName() . '/admin/public_profile.php?profile=' ?>" + hash);
      $('#expire').val(formattedDate);
    });
  });
</script>
<script>
  $(document).ready(function() {

    $('#copyButton').click(function() {
      var input = document.getElementById('url');
      // Pilih teks dalam input form
      input.select();
      // Copy teks ke clipboard
      document.execCommand("copy");
      alert("The link has been copied. Please save it.");

    });
  });
</script>








</body>

</html>