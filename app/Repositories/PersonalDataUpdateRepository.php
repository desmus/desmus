<?php

namespace App\Repositories;

use App\Models\PersonalDataUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method PersonalDataUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataUpdate find($id, $columns = ['*'])
 * @method PersonalDataUpdate first($columns = ['*'])
*/
class PersonalDataUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'personal_data_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataUpdate::class;
    }
}
