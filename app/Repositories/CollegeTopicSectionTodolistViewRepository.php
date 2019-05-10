<?php

namespace App\Repositories;

use App\Models\CollegeTopicSectionTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method CollegeTopicSectionTodolistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolistView find($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolistView first($columns = ['*'])
*/
class CollegeTopicSectionTodolistViewRepository extends BaseRepository
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
        return CollegeTopicSectionTodolistView::class;
    }
}
