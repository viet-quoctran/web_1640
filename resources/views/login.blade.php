@extends('master.master')
@section('content')
<section id="contentSection">
  <div class="contact_area">
    <h2>LOGIN</h2>
    <form action="#" class="contact_form">
      <div class="form-group">
          <input class="form-control" type="text" placeholder="Name*">
      </div>
      <div class="form-group">
          <input class="form-control" type="email" placeholder="Email*">
      </div>
      <div class="form-group">
          <select class="form-control" id="role_select" name="role">
              <option value="student">Student</option>
              <option value="marketing_head">Marketing Head</option>
          </select>
      </div>
      <div class="form-group">
          <input type="submit" value="Send Message" class="btn btn-primary">
      </div>
    </form>
  </div>
</section>
@endsection