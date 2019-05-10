<?php

namespace App\Repositories;

use App\Models\JobTSGaleryTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method JobTSGaleryTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryTodolistCreate find($id, $columns = ['*'])
 * @method JobTSGaleryTodolistCreate first($columns = ['*'])
*/
class JobTSGaleryTodolistCreateRepository extends BaseRepository
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
        return JobTSGaleryTodolistCreate::class;
    }
}
