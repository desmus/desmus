<?php

namespace App\Repositories;

use App\Models\ProjectTSNoteTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method ProjectTSNoteTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNoteTodolistUpdate find($id, $columns = ['*'])
 * @method ProjectTSNoteTodolistUpdate first($columns = ['*'])
*/
class ProjectTSNoteTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSNoteTodolistUpdate::class;
    }
}
