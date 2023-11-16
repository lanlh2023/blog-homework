<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @php
                    $actions = explode('.', Route::current()->getName());
                    $route = 'admin.' . $actions[1] . '.destroy';
                @endphp
                <h5 class="modal-title" id="exampleModalLabel">Form comfirm delete</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body message-delete">Are you sure delete {{ $actions[1] }} with id-{{$model->id}}?<span id="id-delete"></span></div>
            <div class="modal-footer d-flex">
                <button class="btn btn-secondary btn-cancel" type="button" data-dismiss="modal">Cancel</button>
                <form id="delete-form" method="POST" action="{{ route($route, [$model]) }}">
                    @csrf
                    <button type="submit" name="action" value="delete" class="btn btn-danger">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>
