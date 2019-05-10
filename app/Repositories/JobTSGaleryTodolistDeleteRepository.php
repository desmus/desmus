<?php

namespace App\Repositories;

use App\Models\JobTSGaleryTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method JobTSGaleryTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryTodolistDelete find($id, $columns = ['*'])
 * @method JobTSGaleryTodolistDelete first($columns = ['*'])
*/
class JobTSGaleryTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryTodolistDelete::class;
    }
}
