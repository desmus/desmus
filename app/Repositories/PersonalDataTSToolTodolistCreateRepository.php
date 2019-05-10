<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method PersonalDataTSToolTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolistCreate find($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolistCreate first($columns = ['*'])
*/
class PersonalDataTSToolTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolTodolistCreate::class;
    }
}
