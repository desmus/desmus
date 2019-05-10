<?php

namespace App\Repositories;

use App\Models\JobTSToolTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method JobTSToolTodolistView findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolTodolistView find($id, $columns = ['*'])
 * @method JobTSToolTodolistView first($columns = ['*'])
*/
class JobTSToolTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolTodolistView::class;
    }
}
