<?php

namespace App\Repositories;

use App\Models\CollegeTopicSectionTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method CollegeTopicSectionTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolist find($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolist first($columns = ['*'])
*/
class CollegeTopicSectionTodolistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'c_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicSectionTodolist::class;
    }
}
