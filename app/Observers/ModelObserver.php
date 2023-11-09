<?php

namespace App\Observers;

use App\Libs\ValueUtil;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ModelObserver
{
    /**
     * Handle the model "creating" event.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function creating($model)
    {
        $model->user_id = auth()->user()->id;
    }

    /**
     * Handle the model "updating" event.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updating($model)
    {
    }

    /**
     * Handle the model "restored" event.
     * @param Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function restored($model)
    {
    }

    /**
     * Handle the model "forceDeleted" event.
     * @param Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function forceDeleted($model)
    {
    }
}
