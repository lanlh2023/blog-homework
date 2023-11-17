@extends('dashboard-master-layout')

@section('title', 'Dashboard')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/admin/user.css') }}">
@stop

@section('content')
    <!--Container Main start-->
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table-wrap">
        @if (!empty($users))
            <div class="pagination-wrap d-flex justify-content-end px-4 pt-4">
                {{ $users->withQueryString()->links('vendor.pagination.custom') }}
            </div>
        @endif
        <div class="table w-100 py-4">
            <div class="content-table col-12">
                <table class="table table-striped table-hover table-bordered align-middle table-responsive">
                    <thead>
                        <tr>
                            <th class="align-middle" scope="col" style="width: 5%"><label>ID</label></th>
                            <th class="align-middle" scope="col" style="width: 20%"><label>User Name</label></th>
                            <th class="align-middle" scope="col" style="width: 40%"><label>Position Name</label></th>
                            <th class="align-middle" scope="col" style="width: 10%"><label>Created Date</label></th>
                            <th class="align-middle" scope="col" style="width: 10%"><label>Updated Date</label></th>
                            <th class="align-middle" scope="col" style="width: 15%"><label>Action</label></th>
                        </tr>
                    </thead>
                    @if (!empty($users))
                        <tbody>
                            @foreach ($users as $user)
                                {{-- $user->roles->first()?->name ?? ''  --}}
                                <tr class="align-middle">
                                    <td class="align-middle"> <label>{{ $user->id }}</label></td>
                                    <td class="align-middle"> <label>{{ $user->name }}</label></td>
                                    <td class="align-middle">
                                        <select class="form-control" class="role_user" name="role_user">
                                            <option value="" selected >none</option>
                                            @foreach ($roles as $role)
                                                <option class="" value="{{ $role->id }}"
                                                    {{
                                                        isset($role->id) && $role->id == $user->roles->first()?->id ? 'selected' : ''
                                                    }}
                                                    >{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="align-middle"> <label>{{ $user->created_at }}</label></td>
                                    <td class="align-middle"> <label>{{ $user->updated_at }}</label></td>
                                    <td class="align-middle action-group">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
                @if (empty($users))
                    <div class="d-flex justify-content-center" style="font-size: 20px">
                        No User Found
                    </div>
                @endif
            </div>
            <div class="btn-group m-3">
                <a href="{{ route('admin.role_user.create') }}" class="btn btn-primary d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.25em"
                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                    </svg>
                    Add
                </a>
            </div>
        </div>
    </div>
    <!--Container Main end-->
@stop
@section('scripts')
    @if (!is_null(session('message')))
        <script>
            alert("{{ session('message') }}")
        </script>
    @endif
@stop
