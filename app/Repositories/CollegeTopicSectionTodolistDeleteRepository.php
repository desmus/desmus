<?php

namespace App\Repositories;

use App\Models\CollegeTopicSectionTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method CollegeTopicSectionTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolistDelete find($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolistDelete first($columns = ['*'])
*/
class CollegeTopicSectionTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicSectionTodolistDelete::class;
    }
}
