@extends('main')

@section('content')
    <div>
        <!-- Button trigger modal -->
        @can('role.create')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Create New Role
            </button>
        @endcan

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRoleModal">Create New Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ url('manage') }}" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <label class="col-lg-2 control-label" for="name">Role Name</label>
                            <div class="col-lg-4">
                                <input class="form-control" id="name" name="name" type="text">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="datatable" class="table table-sm table-hover table-bordered" style="margin-bottom: 30px;">
            <thead class="thead-light">
                <th scope="col">Role Name</th>
                <th scope="col">Permissions</th>
                <th scope="col">Users</th>
                <th scope="col">Edit</th>
            </thead>

            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <ul>
                            @foreach ($role->permissions as $permission)
                                <li>
                                    {{ $permission->name }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach ($role->users as $user)
                                <li>
                                    {{ $user->name }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @can('role.update')
                            <a href="{{ URL::to('manage/' . $role->id . '/edit') }}" class="btn btn-success">Assign
                                Permissions</a>
                        @endcan
                        @can('role.delete')
                            <a href="{{ URL::to('delete_users/') }}" class="btn btn-danger">Delete</a>
                        @endcan

                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
