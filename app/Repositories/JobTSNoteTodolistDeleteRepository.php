<?php

namespace App\Repositories;

use App\Models\JobTSNoteTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method JobTSNoteTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSNoteTodolistDelete find($id, $columns = ['*'])
 * @method JobTSNoteTodolistDelete first($columns = ['*'])
*/
class JobTSNoteTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSNoteTodolistDelete::class;
    }
}
