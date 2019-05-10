<?php

namespace App\Repositories;

use App\Models\PersonalDataTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:07 am UTC
 *
 * @method PersonalDataTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTodolistCreate find($id, $columns = ['*'])
 * @method PersonalDataTodolistCreate first($columns = ['*'])
*/
class PersonalDataTodolistCreateRepository extends BaseRepository
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
        return PersonalDataTodolistCreate::class;
    }
}
