<?php

namespace App\Repositories;

use App\Models\JobTSNoteTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method JobTSNoteTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSNoteTodolistCreate find($id, $columns = ['*'])
 * @method JobTSNoteTodolistCreate first($columns = ['*'])
*/
class JobTSNoteTodolistCreateRepository extends BaseRepository
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
        return JobTSNoteTodolistCreate::class;
    }
}
