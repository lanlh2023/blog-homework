@extends('dashboard-master-layout')

@section('title', 'Dashboard')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/post.css') }}">
@stop

@section('content')
    <!--Container Main start-->
    <div class="col-12 p-col-0 col-xl-10 col-lg-9 col-md-9 content-table-wrap">
        @include('partial.form.toast-message')
        @if (!empty($posts))
            <div class="pagination-wrap d-flex justify-content-end px-4 pt-4">
                {{ $posts->appends(request()->all())->links('vendor.pagination.custom') }}
            </div>
            <form action="" method="GET">
                <div class="row px-4 py-2 mb-2 justify-content-between">
                    <x-form.group-input>
                        <x-slot:div class="col-md-12 col-lg-5 p-0">
                        </x-slot:div>
                        <x-slot:label>
                            Content Search:
                        </x-slot:label>
                        <x-slot:input value="{{ old('content_search', $conditions['content_search'] ?? '') }}"
                            name="content_search">
                        </x-slot:input>
                    </x-form.group-input>
                    <x-form.group-input>
                        <x-slot:div class="col-md-12 col-lg-5 p-0">
                        </x-slot:div>
                        <x-slot:label>
                            User Name:
                        </x-slot:label>
                        <x-slot:input value="{{ old('user_name_search', $conditions['user_name_search'] ?? '') }}"
                            name="user_name_search">
                        </x-slot:input>
                    </x-form.group-input>
                </div>
                <a class="btn btn-secondary pl-3 float-right mr-4" href="{{ route('admin.post.index') }}">Clear</a>
                <button class="btn btn-info pl-3 float-right mr-4" type="submit" name="search"
                    value="search">Search</button>
            </form>
            <a href="{{ url('admin/post/exportCsv') . '?' . http_build_query(request()->except('page')) }}"
                class="ml-3 btn btn-success">Export csv <svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                    <path
                        d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z" />
                </svg>
            </a>
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
                                    <td class="align-middle"> <label>{{ $post->content_title }}</label></td>
                                    <td class="align-middle"> <label>{{ $post->created_at }}</label></td>
                                    <td class="align-middle"> <label>{{ $post->updated_at }}</label></td>
                                    <td class="align-middle action-group">
                                        <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}"
                                            class="btn btn-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path
                                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                            </svg>
                                        </a>
                                        <a href=" {{ route('admin.post.show', ['id' => $post->id]) }} "
                                            class="btn btn-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1.25em"
                                                viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path
                                                    d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                            </svg>
                                        </a>
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
            <div class="btn-group m-3">
                <a href="{{ route('admin.post.create') }}" class="btn btn-primary d-flex align-items-center">
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
@stop
