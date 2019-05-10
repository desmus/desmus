<?php

namespace App\Repositories;

use App\Models\JobTSFileTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method JobTSFileTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSFileTodolistCreate find($id, $columns = ['*'])
 * @method JobTSFileTodolistCreate first($columns = ['*'])
*/
class JobTSFileTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSFileTodolistCreate::class;
    }
}
