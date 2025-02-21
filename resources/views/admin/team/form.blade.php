@extends('admin.layouts.master')
@php
    $title =isset($row) && !empty($row) ? 'Edit Team' : 'Create Team';
    $action =isset($row) && !empty($row) ? route('admin.teams.update', $row->id) : route('admin.teams.store');
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
                                    <label for="fullname">Fullname <span class="text text-red">*</span></label>
                                    <input type="text" name="fullname" value="{{old('fullname', isset($row) && !empty($row) ? $row->fullname : null) }}" class="form-control" id="fullname" placeholder="Fullname">
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation <span class="text text-red">*</span></label>
                                    <input type="text" name="designation" value="{{old('designation', isset($row) && !empty($row) ? $row->designation : null) }}" class="form-control" id="designation" placeholder="Designation">
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" name="telephone" value="{{old('telephone', isset($row) && !empty($row) ? $row->telephone : null) }}" class="form-control" id="telephone" placeholder="Telephone">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" value="{{old('mobile', isset($row) && !empty($row) ? $row->mobile : null) }}" class="form-control" id="mobile" placeholder="Mobile">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text text-red">*</span></label>
                                    <input type="text" name="email" value="{{old('email', isset($row) && !empty($row) ? $row->email : null) }}" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="profile">Profile <span class="text text-red">*</span></label>
                                    <input type="text" name="profile" value="{{old('profile', isset($row) && !empty($row) ? $row->profile : null) }}" class="form-control" id="profile" placeholder="Profile">
                                </div>
                                <!-- <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ old('description', isset($row) && !empty($row) ? $row->description : null) }}</textarea>
                                </div> -->
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="team_img">Team Image <span class="text text-red">*</span></label>
                                    <input type="file" name="team_img" class="form-control" id="team_img">
                                    @if(isset($row) && !empty($row))
                                        <img src="{{ asset($row->team_img) }}" width="30" height="30">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="facebook_id">Facebook ID <span class="text text-red">*</span></label>
                                    <input type="text" name="facebook_id" class="form-control" value="{{ old('facebook_id', isset($row) && !empty($row) ? $row->facebook_id : null) }}" id="facebook_id" placeholder="Facebook ID">
                                </div>
                                <div class="form-group">
                                    <label for="twitter_id">Twitter ID <span class="text text-red">*</span></label>
                                    <input type="text" name="twitter_id" value="{{ old('twitter_id', isset($row) && !empty($row) ? $row->twitter_id : null) }}" class="form-control" id="twitter_id" placeholder="Twitter ID">
                                </div>
                                <div class="form-group">
                                    <label for="pinterest_id">Pinterest ID <span class="text text-red">*</span></label>
                                    <input type="text" name="pinterest_id" value="{{ old('pinterest_id', isset($row) && !empty($row) ? $row->pinterest_id : null) }}" class="form-control" id="pinterest_id" placeholder="Pinterest ID">
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