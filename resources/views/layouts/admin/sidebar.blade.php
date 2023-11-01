<div class="sidebar col-lg-2 col-md-3 col-sm-12 col-12">
    <div class="wrap p-0 h-100 d-inline-block w-100">
        <div class="content h-100 d-inline-block w-100">
            <input type="checkbox" hidden id="navbar-checkbox">
            <div class="menu-list h-100  d-inline-block w-100 bg-dark px-3 py-3">
                <div class="menu-item d-flex align-items-center justify-content-around w-100 px-3 py-3 mb-2 w-100 text-center {{ request()->is('admin/post*') ? 'active' : '' }}"
                    style="border-radius: 10px">
                    <i class="fa-solid fa-signs-post"></i>
                    <a class="text-decoration-none" href="{{ route('admin.post.index') }}">Post
                        List</a>
                </div>
                <div class="menu-item d-flex align-items-center justify-content-around w-100 px-3 py-3 mb-2 w-100 text-center {{ request()->is('admin/user*') ? 'active' : '' }}"
                    style="border-radius: 10px">
                    <i class="fa-solid fa-user"></i>
                    <a class="text-decoration-none" href="{{ route('admin.post.index') }}">User
                        List</a>
                </div>
            </div>
            <label for="navbar-checkbox">
                <div class="icon-bar">
                    <i class="fa-solid fa-bars fa-xl"></i>
                </div>
            </label>
        </div>
    </div>
</div>
