<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method PersonalDataTopicTodolist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicTodolist find($id, $columns = ['*'])
 * @method PersonalDataTopicTodolist first($columns = ['*'])
*/
class PersonalDataTopicTodolistRepository extends BaseRepository
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
        'p_d_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicTodolist::class;
    }
}
