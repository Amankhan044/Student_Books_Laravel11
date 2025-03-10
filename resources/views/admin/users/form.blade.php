@extends("admin.layouts.master")

@section("page-title")
{{ isset($user) ? "Edit User" : "Create User" }}
@endsection

@section("content")
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ isset($user) ? "Edit User" : "Create User" }}</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
                    @csrf
                    @if(isset($user))
                        @method('POST')
                    @endif

                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" name="name" class="form-control" id="name" 
       value="{{ isset($user) ? old('name', $user->name) : '' }}" required>

                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input autocomplete="off" type="email" name="email" class="form-control" id="email" 
       value="{{ isset($user) ? old('email', $user->email) : '' }}" required>
       @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif

                    </div>

                    <div class="form-group">
    <label for="password">Password {{ isset($user) ? "(Leave blank to keep current password)" : "*" }}</label>
    <input autocomplete="off" type="password" name="password" class="form-control" id="password">
    @if ($errors->has('password'))
    <span class="text-danger">{{ $errors->first('password') }}</span>
@endif
</div>

<div class="form-group">
    <label for="password_confirmation">Confirm Password {{ isset($user) ? "(Leave blank if unchanged)" : "*" }}</label>
    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
</div>


                    <button type="submit" class="btn btn-primary">{{ isset($user) ? "Update" : "Create" }}</button>
                    <a href="{{ route('admin.users.index') }}" type="reset" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
