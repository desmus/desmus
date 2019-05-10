<?php

namespace App\Repositories;

use App\Models\JobTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method JobTodolistView findWithoutFail($id, $columns = ['*'])
 * @method JobTodolistView find($id, $columns = ['*'])
 * @method JobTodolistView first($columns = ['*'])
*/
class JobTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTodolistView::class;
    }
}
