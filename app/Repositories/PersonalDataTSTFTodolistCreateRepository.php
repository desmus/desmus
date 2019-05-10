<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTFTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTFTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method PersonalDataTSTFTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolistCreate find($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolistCreate first($columns = ['*'])
*/
class PersonalDataTSTFTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTFTodolistCreate::class;
    }
}
