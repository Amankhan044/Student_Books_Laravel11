@extends('admin.layouts.master')

@php
  $title = isset($book) && !empty($book) ? 'Edit Book' : 'Create Book';
  $action = isset($book) && !empty($book) ? route('admin.books.update', $book->id) : route('admin.books.store');
@endphp

@section('page-title')
{{ $title }}
@endsection

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      {{ $title }}
      <small>All * fields are required</small>
    </h1>
  </section>

  <section class="content">
    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label for="title">Title <span class="text text-red">*</span></label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title', $book->title ?? '') }}">
              </div>

              <div class="form-group">
                <label for="slug">Slug <span class="text text-red">*</span></label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ old('slug', $book->slug ?? '') }}">
              </div>

              <div class="form-group">
                <label>Category <span class="text text-red">*</span></label>
                <select class="form-control" name="category_id" id="category_id">
                  <option value="">-- Select Category --</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                      {{ $category->title }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Author <span class="text text-red">*</span></label>
                <select class="form-control" name="author_id" id="author_id">
                  <option value="">-- Select Author --</option>
                  @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>
                      {{ $author->title }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="availability">Availability <span class="text text-red">*</span></label>
                <input type="text" class="form-control" name="availability" id="availability" placeholder="Availability" value="{{ old('availability', $book->availability ?? '') }}">
              </div>

              <div class="form-group">
                <label for="rating">Rating <span class="text text-red">*</span></label>
                <input type="text" class="form-control" name="rating" id="rating" placeholder="Rating" value="{{ old('rating', $book->rating ?? '') }}">
              </div>

              <div class="form-group">
                <label for="price">Price <span class="text text-red">*</span></label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="{{ old('price', $book->price ?? '') }}">
              </div>

              <div class="form-group">
                <label for="publisher">Publisher</label>
                <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher" value="{{ old('publisher', $book->publisher ?? '') }}">
              </div>

              <div class="form-group">
                <label>Country of Publisher <span class="text text-red">*</span></label>
                <select class="form-control" name="country_of_publisher" id="country_of_publisher">
                  <option value="">-- Select Country --</option>
                  @foreach($countries as $country)
                    <option value="{{ $country->name }}" {{ old('country_of_publisher', $book->country_of_publisher ?? '') == $country->name ? 'selected' : '' }}>
                      {{ $country->name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN" value="{{ old('isbn', $book->isbn ?? '') }}">
              </div>

              <div class="form-group">
                <label for="isbn_10">ISBN-10</label>
                <input type="text" class="form-control" name="isbn_10" id="isbn_10" placeholder="ISBN-10" value="{{ old('isbn_10', $book->isbn_10 ?? '') }}">
              </div>
            </div>

            <div class="col-xs-6">
              <div class="form-group">
                <label for="book_img">Book Image</label>
                <input type="file" class="form-control" name="book_img" id="book_img">
                @if(isset($book) && $book->book_img)
                  <img src="{{ asset($book->book_img) }}" width="100">
                @endif
              </div>

              <div class="form-group">
                <label for="book_upload">Book Upload (PDF)</label>
                <input type="file" class="form-control" name="book_upload" id="book_upload">
                @if(isset($book) && $book->book_upload)
                  <a href="{{ asset($book->book_upload) }}" target="_blank">View PDF</a>
                @endif
              </div>

              <div class="form-group">
                <label for="audience">Audience</label>
                <input type="text" class="form-control" name="audience" id="audience" placeholder="Audience" value="{{ old('audience', $book->audience ?? '') }}">
              </div>

              <div class="form-group">
                <label for="format">Format</label>
                <input type="text" class="form-control" name="format" id="format" placeholder="Format" value="{{ old('format', $book->format ?? '') }}">
              </div>

              <div class="form-group">
                <label for="language">Language</label>
                <input type="text" class="form-control" name="language" id="language" placeholder="Language" value="{{ old('language', $book->language ?? '') }}">
              </div>

              <div class="form-group">
                <label for="total_pages">Total Pages</label>
                <input type="text" class="form-control" name="total_pages" id="total_pages" placeholder="Total Pages" value="{{ old('total_pages', $book->total_pages ?? '') }}">
              </div>

              <div class="form-group">
                <label for="edition_number">Edition Number</label>
                <input type="text" class="form-control" name="edition_number" id="edition_number" placeholder="Edition Number" value="{{ old('edition_number', $book->edition_number ?? '') }}">
              </div>

              <div class="form-group">
                <label>Recommended</label>
                <select class="form-control" name="recommended" id="recommended">
                  <option value="no" {{ old('recommended', $book->recommended ?? 'no') == 'no' ? 'selected' : '' }}>Not Recommended</option>
                  <option value="yes" {{ old('recommended', $book->recommended ?? 'no') == 'yes' ? 'selected' : '' }}>Recommended</option>
                </select>
              </div>

              <div class="form-group">
                <label for="description">Description <span class="text text-red">*</span></label>
                <textarea class="form-control" name="description" rows="5" id="description">{{ old('description', $book->description ?? '') }}</textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-danger">Cancel</button>
        </div>
      </div>
    </form>
  </section>
</div>
@endsection
