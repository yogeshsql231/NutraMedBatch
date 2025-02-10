@extends('layouts.masterLayout')

@section('title','Users')

@section('content')

<div class="section-header">
    <h1> User List</h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table-2">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"> S.R.</th>
                                <th scope="col"> User Name</th>
                                <th scope="col"> Email</th>
                                <th scope="col">Role </th>
                                @can('User-delete')
                                <th scope="col">Action </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td> @if ($user->roles->isEmpty())
                                    No roles assigned
                                    @else
                                    @foreach ($user->roles as $role)
                                    <span class="badge bg-success">{{ $role->name }}</span>
                                    @endforeach
                                    @endif
                                </td>

                                @can('User-delete')
                                <td>
                                    {{-- <a href="{{ route('customer.edit', ['customer' => $customer->id]) }}"
                                        title="Edit Customer">
                                        <i class="fas fa-edit fa-1x"></i>
                                    </a> --}}


                                    <form action="{{route('admin.users.destroy',['user'=>$user->id])}}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border:none; background:none;"
                                            title="Delete Customer"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash fa-1x text-danger"></i>
                                        </button>
                                    </form>

                                </td>
                                @endcan

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection