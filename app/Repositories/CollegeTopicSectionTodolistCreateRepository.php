<?php

namespace App\Repositories;

use App\Models\CollegeTopicSectionTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:07 am UTC
 *
 * @method CollegeTopicSectionTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolistCreate find($id, $columns = ['*'])
 * @method CollegeTopicSectionTodolistCreate first($columns = ['*'])
*/
class CollegeTopicSectionTodolistCreateRepository extends BaseRepository
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
        return CollegeTopicSectionTodolistCreate::class;
    }
}
