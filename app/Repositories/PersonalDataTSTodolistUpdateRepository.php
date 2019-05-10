<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method PersonalDataTSTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTodolistUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSTodolistUpdate first($columns = ['*'])
*/
class PersonalDataTSTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTodolistUpdate::class;
    }
}
