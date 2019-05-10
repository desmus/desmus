<?php

namespace App\Repositories;

use App\Models\JobTSToolTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method JobTSToolTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolTodolistDelete find($id, $columns = ['*'])
 * @method JobTSToolTodolistDelete first($columns = ['*'])
*/
class JobTSToolTodolistDeleteRepository extends BaseRepository
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
        return JobTSToolTodolistDelete::class;
    }
}
