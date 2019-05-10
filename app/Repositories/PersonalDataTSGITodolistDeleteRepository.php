<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGITodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGITodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:17 am UTC
 *
 * @method PersonalDataTSGITodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGITodolistDelete find($id, $columns = ['*'])
 * @method PersonalDataTSGITodolistDelete first($columns = ['*'])
*/
class PersonalDataTSGITodolistDeleteRepository extends BaseRepository
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
        return PersonalDataTSGITodolistDelete::class;
    }
}
