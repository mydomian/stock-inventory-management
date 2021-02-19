@extends('layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">User list</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">User List</h5><br>

                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add User</a><br><br>
    
                            <table class="table table-bordered datatable">
                                <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($users)
                                    @foreach($users as $key => $users)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $users->name ?? '' }}</td>
                                            <td>{{ $users->email ?? '' }} @if(Auth::id() == $users->id) (you) @endif</td>
                                            <td>{{ $users->created_at->format('yy-m-d') ?? '' }}</td>
                                            <td>
                                                <a href="{{ route('users.edit', $users->id) }}" class="btn btn-sm btn-info">
                                                   <i class="fa fa-edit"></i> Edit
                                                </a>
                                                @if(Auth::id() != $users->id)
                                                    <a href="javascript:;" class="btn btn-sm btn-danger sa-delete" data-form-id="users-delete-{{ $users->id }}">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>

                                                    <form id="users-delete-{{ $users->id }}" action="{{ route('users.destroy', $users->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div><!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
