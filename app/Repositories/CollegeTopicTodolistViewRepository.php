<?php

namespace App\Repositories;

use App\Models\CollegeTopicTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method CollegeTopicTodolistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicTodolistView find($id, $columns = ['*'])
 * @method CollegeTopicTodolistView first($columns = ['*'])
*/
class CollegeTopicTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicTodolistView::class;
    }
}
