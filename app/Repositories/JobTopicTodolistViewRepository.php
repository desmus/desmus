<?php

namespace App\Repositories;

use App\Models\JobTopicTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method JobTopicTodolistView findWithoutFail($id, $columns = ['*'])
 * @method JobTopicTodolistView find($id, $columns = ['*'])
 * @method JobTopicTodolistView first($columns = ['*'])
*/
class JobTopicTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicTodolistView::class;
    }
}
