<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method PersonalDataTSToolTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolistUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolistUpdate first($columns = ['*'])
*/
class PersonalDataTSToolTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolTodolistUpdate::class;
    }
}
