<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGITodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGITodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method PersonalDataTSGITodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGITodolistCreate find($id, $columns = ['*'])
 * @method PersonalDataTSGITodolistCreate first($columns = ['*'])
*/
class PersonalDataTSGITodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGITodolistCreate::class;
    }
}
