<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTFTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTFTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method PersonalDataTSTFTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolistUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolistUpdate first($columns = ['*'])
*/
class PersonalDataTSTFTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTFTodolistUpdate::class;
    }
}
