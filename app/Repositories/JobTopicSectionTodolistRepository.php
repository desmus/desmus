<?php

namespace App\Repositories;

use App\Models\JobTopicSectionTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method JobTopicSectionTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSectionTodolist find($id, $columns = ['*'])
 * @method JobTopicSectionTodolist first($columns = ['*'])
*/
class JobTopicSectionTodolistRepository extends BaseRepository
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
        'j_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicSectionTodolist::class;
    }
}
