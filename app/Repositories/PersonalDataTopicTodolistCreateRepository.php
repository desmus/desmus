<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:07 am UTC
 *
 * @method PersonalDataTopicTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicTodolistCreate find($id, $columns = ['*'])
 * @method PersonalDataTopicTodolistCreate first($columns = ['*'])
*/
class PersonalDataTopicTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicTodolistCreate::class;
    }
}
