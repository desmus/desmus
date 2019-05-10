<?php

namespace App\Repositories;

use App\Models\CollegeTopicSectionTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method CollegeTopicSectionTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolistUpdate find($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolistUpdate first($columns = ['*'])
*/
class CollegeTopicSectionTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicSectionTodolistUpdate::class;
    }
}
