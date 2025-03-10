@extends("admin.layouts.master")

@section("page-title")
Manage Users
@endsection

@section("content")
<div class="content-wrapper">
    <section class="content-header">
        <h1>Manage Users</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title"> 
                    <a class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
                    <a class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
              </h3>
            </div>

            <div class="box-body">
                <table class="table table-bordered">
                    <thead style="background-color: #F8F8F8;">
                        <tr>
                         <th width="4%"><input type="checkbox" name="" id="checkAll"></th>

                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->password }}</td>
                            
                            <td>
                      <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                      <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></button>
                      </form>
                  </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
