@extends('admin.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Book
      <small>All * field required</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->

<form action="{{ route('admin.books.store') }}" method="post">
    @csrf
<div class="box box-primary">
      <!-- /.box-header -->
      <div class="box-body">
        <!-- row start -->
        <div class="row"> 
              <div class="col-xs-6">
                
               <div class="form-group">
                  <label for="title">Title <span class="text text-red">*</span></label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                  </div>

                  <div class="form-group">
                  <label for="slug">Slug <span class="text text-red">*</span></label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
                  </div>
                  <div class="form-group">
                    <label>Category <span class="text text-red">*</span></label>
                    <select class="form-control" name="category_id" id="category_id" style="width: 100%;">
                      <option value="none">-- Select Category --</option>
                      @foreach($categories as $category)
                      <option value="{{$category->title}}">{{$category->title}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Author <span class="text text-red">*</span></label>
                    <select class="form-control" name="author_id" id="author_id" style="width: 100%;">
                      <option value="none">-- Select Author --</option>
                      @foreach($authors as $author)
                      <option value="{{$author->title}}">{{$author->title}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="availability">Availability <span class="text text-red">*</span></label>
                    <input type="text" class="form-control" name="availability" id="availability" placeholder="Availability">
                  </div>
                  <div class="form-group">
                <label for="price">Price: <span class="text text-red">*</span></label> 
                <input type="text" class="form-control" name="price" id="price" placeholder="Price">
               </div>
                <div class="form-group">
                  <label for="publisher">Publisher</label>
                  <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher">
                </div>
                <div class="form-group">
                  <label>Country of Publisher <span class="text text-red">*</span></label>
                  <select class="form-control select2" name="country_of_publisher" id="country_of_publisher" style="width: 100%;">
                    <option value="none"> -- Select Country -- </option>
                    @foreach($countries as $country)
                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="isbn">ISBN</label>
                  <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN">
                </div>

                  <div class="form-group">
                    <label for="isbn_10">ISBN-10</label>
                    <input type="text" class="form-control" name="isbn_10" id="isbn_10" placeholder="ISBN-10">
                  </div>
              </div>
               
              <div class="col-xs-6">
                  <div class="form-group">
                    <label for="book_img">Book Image</label>
                    <input type="file" class="form-control" name="book_img" id="book_img" >
                    <small class="label label-warning">Cover Photo will be uploaded</small>
                  </div>
                  <div class="form-group">
                    <label for="book_upload">Book Upload</label>
                    <input type="file" class="form-control" name="book_upload" id="book_upload" >
                    <small class="label label-warning">Book (PDF) will be uploaded </small>
                  </div>
                <div class="form-group">
                    <label for="audience">Audience</label>
                    <input type="text" class="form-control" name="audience" id="audience" placeholder="Audience">
                  </div>

                  <div class="form-group">
                    <label for="format">Format</label>
                    <input type="text" class="form-control" name="format" id="format" placeholder="Format">
                  </div>

                  <div class="form-group">
                    <label for="language">Language</label>
                    <input type="text" class="form-control" name="language" id="language" placeholder="Language">
                  </div>
                  <div class="form-group">
                    <label for="total_pages">Total Pages</label>
                    <input type="text" class="form-control" name="total_pages" id="total_pages" placeholder="Total Pages">
                  </div>
                  <div class="form-group">
                    <label for="edition_number">Edition Number</label>
                    <input type="text" class="form-control" name="edition_number" id="edition_number" placeholder="Edition Number">
                  </div>

                  <div class="form-group">
                    <label>Recomended</label>
                    <select class="form-control" name="recomended" id="recomended" style="width: 100%;">
                      <option value="none">-- Select Recomended --</option>
                      <option value="yes">Recomended</option>
                      <option value="no">Not Recomended</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="description">Description <span class="text text-red">*</span></label>
                    <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description"></textarea>
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

</form>

  

    <!-- form end -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
