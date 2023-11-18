<div class="sidebar col-lg-2 col-md-3 col-sm-12 col-12">
    <div class="wrap p-0 h-100 d-inline-block w-100">
        <div class="content h-100 d-inline-block w-100">
            <input type="checkbox" hidden id="navbar-checkbox">
            <div class="menu-list h-100  d-inline-block w-100 bg-dark px-3 py-3">
                <div class="menu-item d-flex align-items-center justify-content-around w-100 px-3 py-3 mb-2 w-100 text-center {{ request()->is('admin/post*') ? 'active' : '' }}"
                    style="border-radius: 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                    <a class="text-decoration-none" href="{{ route('admin.post.index') }}">Post
                        List</a>
                </div>
                <div class="menu-item d-flex align-items-center justify-content-around w-100 px-3 py-3 mb-2 w-100 text-center {{ request()->is('admin/user*') ? 'active' : '' }}"
                    style="border-radius: 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                    <a class="text-decoration-none" href="{{ route('admin.user.index') }}">User
                        List</a>
                </div>
            </div>
            <label for="navbar-checkbox">
                <div class="icon-bar">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                </div>
            </label>
        </div>
    </div>
</div>
