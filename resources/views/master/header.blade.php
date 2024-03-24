<header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
          <ul class="top_nav">
            <li><a href="/">Home</a></li>
            @if(Auth::check())
              <!-- Người dùng đã đăng nhập -->
              <li><a href="/user">Profile</a></li>
              <li><a href="/user">Profile</a></li>
            @else
              <!-- Người dùng chưa đăng nhập -->
              <li><a href="/login">Login</a></li>
            @endif
          </ul>
          </div>
          <div class="header_top_right">
            <p>{{ \Carbon\Carbon::now()->format('l, F d, Y') }}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom">
          <div class="logo_area"><a href="index.html" class="logo"><img src="images/logo.jpg" alt=""></a></div>
          <div class="add_banner"><a href="#"><img src="images/addbanner_728x90_V1.jpg" alt=""></a></div>
        </div>
      </div>
    </div>
</header>
<script>
  // Lấy đường dẫn hiện tại
  var currentPath = window.location.pathname;

  // Kiểm tra nếu đường dẫn hiện tại là /login
  if (currentPath === "/login") {
    // Ẩn phần header_bottom bằng cách đặt display: none;
    document.querySelector('.header_bottom').style.display = 'none';
  }
</script>