<?php

namespace App\Repositories;

use App\Models\JobTSGImageTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGImageTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method JobTSGImageTodolistView findWithoutFail($id, $columns = ['*'])
 * @method JobTSGImageTodolistView find($id, $columns = ['*'])
 * @method JobTSGImageTodolistView first($columns = ['*'])
*/
class JobTSGImageTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGImageTodolistView::class;
    }
}
