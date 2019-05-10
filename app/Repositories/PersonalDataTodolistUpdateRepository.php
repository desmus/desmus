<?php

namespace App\Repositories;

use App\Models\PersonalDataTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method PersonalDataTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTodolistUpdate find($id, $columns = ['*'])
 * @method PersonalDataTodolistUpdate first($columns = ['*'])
*/
class PersonalDataTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTodolistUpdate::class;
    }
}
