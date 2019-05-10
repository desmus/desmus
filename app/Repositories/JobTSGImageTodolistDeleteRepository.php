<?php

namespace App\Repositories;

use App\Models\JobTSGImageTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGImageTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method JobTSGImageTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSGImageTodolistDelete find($id, $columns = ['*'])
 * @method JobTSGImageTodolistDelete first($columns = ['*'])
*/
class JobTSGImageTodolistDeleteRepository extends BaseRepository
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
        return JobTSGImageTodolistDelete::class;
    }
}
