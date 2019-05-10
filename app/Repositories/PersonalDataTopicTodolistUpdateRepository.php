<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method PersonalDataTopicTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicTodolistUpdate find($id, $columns = ['*'])
 * @method PersonalDataTopicTodolistUpdate first($columns = ['*'])
*/
class PersonalDataTopicTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicTodolistUpdate::class;
    }
}
