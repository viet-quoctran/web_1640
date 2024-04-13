@extends('master.master')
@section('content')
<section id="contentSection">
  <div class="contact_area">
    <h2>LOGIN</h2>
    <form action="{{ route('user.login') }}" method="POST" class="contact_form">
      @csrf
      <div class="form-group">
          <input class="form-control" type="text" name="email" placeholder="Email*"> <!-- Sử dụng email để đăng nhập -->
      </div>
      <div class="form-group">
          <input class="form-control" type="password" name="password" placeholder="Password*"> <!-- Thêm trường nhập mật khẩu -->
      </div>
      <div class="form-group">
          <select class="form-control" id="role_select" name="role">
              <option value="1">Sign in with Marketing Head</option>
              <option value="2">Sign in with Student</option>
              <option value="3">Sign in with Manager</option>
          </select>
      </div>
      <div class="form-group">
          <input type="submit" value="Login" class="btn btn-primary">
      </div>
    </form>
    @if($errors->any())
      <div class="alert alert-danger">
          @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
          @endforeach
      </div>
    @endif
  </div>
</section>
@endsection