<?php

namespace App\Repositories;

use App\Models\JobTopicSectionTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method JobTopicSectionTodolistView findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSectionTodolistView find($id, $columns = ['*'])
 * @method JobTopicSectionTodolistView first($columns = ['*'])
*/
class JobTopicSectionTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicSectionTodolistView::class;
    }
}
