<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method PersonalDataTSGaleryTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolistCreate find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolistCreate first($columns = ['*'])
*/
class PersonalDataTSGaleryTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryTodolistCreate::class;
    }
}
