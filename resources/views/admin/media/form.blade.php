@extends('admin.layouts.master')

@php
    $title = isset($row) && !empty($row) ? 'Edit Media' : 'Create Media';
    $action = isset($row) && !empty($row) ? route('admin.medias.update', $row->slug) : route('admin.medias.store');

@endphp


@section('page-title')
{{ $title }}
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
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
    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- row start -->
          <div class="row"> 
                <div class="col-xs-6">
                  
                  <div class="form-group">
                    <label for="title">Title <span class="text text-red">*</span></label>
                      <input type="text" name="title" class="form-control" id="title" placeholder="Title " value="{{old('title', isset($row) && !empty($row) ? $row->title : null) }}">
                    </div>
 
                    <!-- <div class="form-group">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
                    </div> -->
                    <div class="form-group">
    <label>Media Type <span class="text text-red">*</span></label>
    <select name="media_type" id="media_type" class="form-control" style="width: 100%;">
        <option value="none" {{ old('media_type', isset($row) ? $row->media_type : '') == 'none' ? 'selected' : '' }}>-- Select Media Type --</option>
        <option value="slider" {{ old('media_type', isset($row) ? $row->media_type : '') == 'slider' ? 'selected' : '' }}>Slider</option>
        <option value="gallery" {{ old('media_type', isset($row) ? $row->media_type : '') == 'gallery' ? 'selected' : '' }}>Gallery</option>
    </select>
</div>

                  </div>
                 
                <div class="col-xs-6">
                   <div class="form-group">
                      <label for="media_img">Media Image <span class="text text-red">*</span></label>
                      <input type="file" name="media_img" class="form-control" id="media_img">
                      @if(isset($row) && !empty($row->media_img))

<img src="{{ asset($row->media_img) }}" alt="Media Image" width="20" height="20">
@endif
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ old('description', isset($row) && !empty($row) ? $row->description : null) }}</textarea>
                     </div>
                  </div>
            </div>

              <!-- row end -->

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" href="{{ route('admin.users.index') }}" class="btn btn-danger">Cancel</button>
          </div>
      </div>
      <!-- /.box -->


    </form>

     
      <!-- form end -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection