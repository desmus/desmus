<?php

namespace App\Repositories;

use App\Models\JobTSGImageTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGImageTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method JobTSGImageTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSGImageTodolistCreate find($id, $columns = ['*'])
 * @method JobTSGImageTodolistCreate first($columns = ['*'])
*/
class JobTSGImageTodolistCreateRepository extends BaseRepository
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
        return JobTSGImageTodolistCreate::class;
    }
}
