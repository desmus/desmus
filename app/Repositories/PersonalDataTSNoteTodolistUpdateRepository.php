<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNoteTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method PersonalDataTSNoteTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolistUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolistUpdate first($columns = ['*'])
*/
class PersonalDataTSNoteTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSNoteTodolistUpdate::class;
    }
}
