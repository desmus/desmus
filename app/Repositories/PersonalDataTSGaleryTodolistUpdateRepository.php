<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method PersonalDataTSGaleryTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolistUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolistUpdate first($columns = ['*'])
*/
class PersonalDataTSGaleryTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryTodolistUpdate::class;
    }
}
