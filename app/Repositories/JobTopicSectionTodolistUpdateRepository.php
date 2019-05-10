<?php

namespace App\Repositories;

use App\Models\JobTopicSectionTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method JobTopicSectionTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSectionTodolistUpdate find($id, $columns = ['*'])
 * @method JobTopicSectionTodolistUpdate first($columns = ['*'])
*/
class JobTopicSectionTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicSectionTodolistUpdate::class;
    }
}
