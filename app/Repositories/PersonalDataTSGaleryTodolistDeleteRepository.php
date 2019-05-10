<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method PersonalDataTSGaleryTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolistDelete find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolistDelete first($columns = ['*'])
*/
class PersonalDataTSGaleryTodolistDeleteRepository extends BaseRepository
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
        return PersonalDataTSGaleryTodolistDelete::class;
    }
}
