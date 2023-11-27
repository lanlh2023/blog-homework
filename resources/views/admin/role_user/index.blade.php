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
        @include('partial.form.toast-message')
        @if (!empty($users))
            <div class="pagination-wrap d-flex justify-content-end px-4 pt-4">
                {{ $users->withQueryString()->links('vendor.pagination.custom') }}
            </div>
        @endif
        <div class="table w-100 py-4">
            <div class="content-table col-12">
                <table class="table table-striped table-hover table-bordered align-middle table-responsive">
                    <thead class="">
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
                                <tr class="align-middle item-user">
                                    <td class="align-middle user_id"> <label>{{ $user->id }}</label></td>
                                    <td class="align-middle"> <label>{{ $user->name }}</label></td>
                                    <td class="align-middle role_user_td">
                                        <select class="form-control role_user" name="role_user">
                                            @foreach ($roles as $role)
                                                <option class="" value="{{ $role->id }}"
                                                    {{ isset($role->id) && $role->id == optional($user->role)->id ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="align-middle"> <label>{{ $user->created_at }}</label></td>
                                    <td class="align-middle"> <label>{{ $user->updated_at }}</label></td>
                                    <td class="align-middle action-group">
                                        <button class="btn btn-warning btn-update-role">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path
                                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                            </svg>
                                        </button>
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
    @include('includes.loadNotification')
    <script src="{{ mix('js/admin/role_user/update.js') }}"></script>
@stop
