<?php

namespace App\Repositories;

use App\Models\JobTSToolTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method JobTSToolTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolTodolistCreate find($id, $columns = ['*'])
 * @method JobTSToolTodolistCreate first($columns = ['*'])
*/
class JobTSToolTodolistCreateRepository extends BaseRepository
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
        return JobTSToolTodolistCreate::class;
    }
}
