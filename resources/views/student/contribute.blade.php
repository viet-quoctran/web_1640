@extends('master.master')
@section('content')
<section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Contribute</h2>
            <form action="{{ route('user.post.contribute') }}" method ="post" enctype="multipart/form-data" class="contact_form">
                @csrf
                <input class="form-control" name="email" type="text" value="{{ Auth::check() ? Auth::user()->email : '' }}" disabled>
                <div class="form-group">
                  <label for="word_files">Upload Word Files</label>
                  <input class="form-control" id="word_files" type="file" name="word_files[]" multiple required>
                </div>
                <div class="form-group">
                  <label for="image_files">Upload Image Files</label>
                  <input class="form-control" id="image_files" type="file" name="image_files[]" accept="image/*" multiple required>
                </div>
                <div class="form-group">
                  <input type="checkbox" id="commitment" name="commitment" required>
                  <label for="commitment">I commit to upload files.</label>
                </div>
                <input style="margin-top:30px" type="submit" value="Upload">
            </form>
            @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
          <div class="single_sidebar">
            <h2><span>Popular Post</span></h2>
            <ul class="spost_nav">
              <li>
                <div class="media wow fadeInDown"> <a href="single_page.html" class="media-left"> <img alt="" src="../images/post_img1.jpg"> </a>
                  <div class="media-body"> <a href="single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 1</a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="single_page.html" class="media-left"> <img alt="" src="../images/post_img2.jpg"> </a>
                  <div class="media-body"> <a href="single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 2</a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="single_page.html" class="media-left"> <img alt="" src="../images/post_img1.jpg"> </a>
                  <div class="media-body"> <a href="single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 3</a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="single_page.html" class="media-left"> <img alt="" src="../images/post_img2.jpg"> </a>
                  <div class="media-body"> <a href="single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 4</a> </div>
                </div>
              </li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
</section>
<script>
    // Lấy tham chiếu đến checkbox và nút upload
    var checkbox = document.getElementById('commitment');
    var uploadButton = document.getElementById('uploadButton');

    // Thêm sự kiện change vào checkbox
    checkbox.addEventListener('change', function() {
        // Nếu checkbox được chọn, cho phép người dùng nhấp vào nút upload
        if (this.checked) {
            uploadButton.disabled = false;
        } else {
            // Nếu checkbox không được chọn, vô hiệu hóa nút upload
            uploadButton.disabled = true;
        }
    });
</script>
@endsection