<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGITodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGITodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method PersonalDataTSGITodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGITodolistUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSGITodolistUpdate first($columns = ['*'])
*/
class PersonalDataTSGITodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGITodolistUpdate::class;
    }
}
