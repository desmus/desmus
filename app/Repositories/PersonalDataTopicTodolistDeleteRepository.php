<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method PersonalDataTopicTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicTodolistDelete find($id, $columns = ['*'])
 * @method PersonalDataTopicTodolistDelete first($columns = ['*'])
*/
class PersonalDataTopicTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_c_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicTodolistDelete::class;
    }
}
