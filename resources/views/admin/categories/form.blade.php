@extends('admin.layouts.master')

@php
    $title = isset($row) && !empty($row) ? 'Edit Category' : 'Create Category';
    $action = isset($row) && !empty($row) ? route('admin.categories.update', $row->slug) : route('admin.categories.store');

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
    <form action="{{ $action }}" method="post">
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
                    <label>Description</label>
                    <textarea  name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{old('description', isset($row) && !empty($row) ? $row->description : null )}}</textarea>
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

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    </form>

      

@endsection