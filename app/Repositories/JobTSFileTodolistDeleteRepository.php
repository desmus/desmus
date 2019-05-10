<?php

namespace App\Repositories;

use App\Models\JobTSFileTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method JobTSFileTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSFileTodolistDelete find($id, $columns = ['*'])
 * @method JobTSFileTodolistDelete first($columns = ['*'])
*/
class JobTSFileTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSFileTodolistDelete::class;
    }
}
