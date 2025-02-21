@extends("admin.layouts.master")

@php
$title=isset($row) && !empty($row)? "Edit Author":"Create Author";
$action=isset($row) && !empty($row)? route('admin.authors.update',$row->slug):route('admin.authors.store');
@endphp
@section("page-title")
{{ $title }}

@endsection


@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ $title }}
        <small>All * field required</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <!-- form start -->
<form action="{{ $action}}" method="post" enctype="multipart/form-data">
@csrf
<div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- row start -->
          <div class="row"> 
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="title">Title <span class="text text-red">*</span></label>
                      <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{old('title', isset($row) && !empty($row) ? $row->title : null) }}">
                    </div>
 
                    <!-- <div class="form-group">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
                    </div> -->
                    <div class="form-group">
                      <label for="designation">Designation <span class="text text-red">*</span></label>
                      <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation" value="{{ old('designation', isset($row) && !empty($row) ? $row->designation : null) }}">
                    </div>
                    <div class="form-group">
                  <label for="dob">Date of birth: <span class="text text-red">*</span></label> 
                  <input type="date" name="dob" class="form-control" id="dob" placeholder="Date of Birth" value="{{old('dob', isset($row) && !empty($row) ? $row->dob : null) }}">
                 </div>
 
                    <div class="form-group">
                      <label for="email">Email <span class="text text-red">*</span></label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{old('email', isset($row) && !empty($row) ? $row->email : null) }}">
                    </div>
                    <div class="form-group">
                      <label>Country <span class="text text-red">*</span></label>
                      <select name="country" id="country" class="form-control select2" style="width: 100%;">
                        <option value="none">-- Select Country --</option>
                        @foreach($countries as $country)  
                        <option value="{{ $country->id }}" {{ old('country', isset($row) && !empty($row) ? $row->country : null) == $country->id ? "selected" : "" }}>{{ $country->name }}</option>
                        @endforeach
                      </select>
                    </div>
 
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{old('phone', isset($row) && !empty($row) ? $row->phone : null) }}">
                    </div>
 
                    <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control"  rows="5" placeholder="Enter ...">{{old('description', isset($row) && !empty($row) ? $row->description : null) }}</textarea>
                  </div>
                </div>
                  
                <div class="col-xs-6">
                   <div class="form-group">
                      <label for="author_img">Author Image <span class="text text-red">*</span></label>
                      <input type="file" name="author_img" class="form-control" id="author_img">
                      @if(isset($row) && !empty($row->author_img))

        <img src="{{ asset($row->author_img) }}" alt="Author Image" width="20" height="20">
    @endif
                    </div>
                  <div class="form-group">
                      <label for="facebook_id">Facebook ID</label>
                      <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID" value="{{ old('facebook_id' ,isset($row) && !empty($row) ? $row->facebook_id : null)}}">
                    </div>
 
                    <div class="form-group">
                      <label for="twitter_id">Twitter ID</label>
                      <input type="text" name="twitter_id" class="form-control" id="twitter_id" placeholder="Twitter ID" value="{{ old('twitter_id', isset($row) && !empty($row) ? $row->twitter_id : null)  }}">
                    </div>
 
                    <div class="form-group">
                      <label for="youtube_id">YouTube ID</label>
                      <input type="text" name="youtube_id" class="form-control" id="youtube_id" placeholder="YouTube ID" value="{{  old('youtube_id', isset($row) && !empty($row) ? $row->youtube_id : null)}} ">                    </div>
                    <div class="form-group">
                      <label for="pinterest_id">Pinterest ID</label>
                      <input type="text" name="pinterest_id" class="form-control" id="pinterest_id" placeholder="Pinterest ID" value="{{ old('pinterest_id' ,isset($row) && !empty($row) ? $row->pinterest_id : null) }}">
                    </div>
                    <div class="form-group">
                    <label>Author Feature</label>
                    <select name="author_feature" id="author_feature" class="form-control select2" style="width: 100%;">
    <option value="no" {{ old('author_feature', isset($row) && $row->author_feature == 'no' ? 'selected' : '') }}>NO</option>
    <option value="yes" {{ old('author_feature', isset($row) && $row->author_feature == 'yes' ? 'selected' : '') }}>YES</option>
</select>

                </div>
                </div>
            </div>
 
              <!-- row end -->
 
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
          </div>
      </div>
      <!-- /.box -->

      <!-- form end -->
</form>

    

    </section>
    <!-- /.content -->
  </div>

@endsection