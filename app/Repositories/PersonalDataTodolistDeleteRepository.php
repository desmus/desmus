<?php

namespace App\Repositories;

use App\Models\PersonalDataTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method PersonalDataTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTodolistDelete find($id, $columns = ['*'])
 * @method PersonalDataTodolistDelete first($columns = ['*'])
*/
class PersonalDataTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTodolistDelete::class;
    }
}
