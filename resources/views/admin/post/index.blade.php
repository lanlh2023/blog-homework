@extends('dashboard-master-layout')

@section('title', 'Dashboard')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/post.css') }}">
@stop

@section('content')
    <!--Container Main start-->
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table-wrap">
        @if (!empty($posts))
            <div class="pagination-wrap d-flex justify-content-end px-4 pt-4">
                {{ $posts->withQueryString()->links('vendor.pagination.custom') }}
            </div>
        @endif
        <div class="table w-100 py-4">
            <div class="content-table col-12">
                <table class="table table-striped table-hover table-bordered align-middle table-responsive">
                    <thead>
                        <tr>
                            <th class="align-middle" scope="col" style="width: 5%"><label>ID</label></th>
                            <th class="align-middle" scope="col" style="width: 10%"><label>User</label></th>
                            <th class="align-middle" scope="col" style="width: 15%"><label>Post Title</label></th>
                            <th class="align-middle" scope="col" style="width: 40%"><label>Post Cotent</label></th>
                            <th class="align-middle" scope="col" style="width: 10%"><label>Created Date</label></th>
                            <th class="align-middle" scope="col" style="width: 10%"><label>Updated Date</label></th>
                            <th class="align-middle" scope="col" style="width: 10%"><label>Action</label></th>
                        </tr>
                    </thead>
                    @if (!empty($posts))
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="align-middle">
                                    <td class="align-middle"> <label>{{ $post->id }}</label></td>
                                    <td class="align-middle"> <label>{{ $post->user?->name ?? '' }}</label></td>
                                    <td class="align-middle"> <label>{{ $post->title }}</label></td>
                                    <td class="align-middle"> <label>{{ $post->content }}</label></td>
                                    <td class="align-middle"> <label>{{ $post->created_at }}</label></td>
                                    <td class="align-middle"> <label>{{ $post->updated_at }}</label></td>
                                    <td class="align-middle action-group">
                                        <i class="fa-solid fa-pen-to-square fa-lg mr-3 text-warning" class="icon-edit"></i>
                                        <i class="fa-solid fa-trash fa-xl text-danger" class="icon-delete"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
                @if (empty($posts))
                    <div class="d-flex justify-content-center" style="font-size: 20px">
                        No Post Found
                    </div>
                @endif
            </div>
            <div class="group-btn d-flex p-3">
                <a href="{{ route('admin.post.create') }}" class="btn btn-primary py-2 px-3 d-flex"><svg
                        xmlns="http://www.w3.org/2000/svg" height="1.25em"
                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <style>
                            svg {
                                fill: #ffffff;
                            }
                        </style>
                        <path
                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                    </svg>Add</a>
            </div>
        </div>
    </div>
    <!--Container Main end-->
@stop

@section('scripts')
@stop
