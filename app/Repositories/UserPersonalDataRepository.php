<?php

namespace App\Repositories;

use App\Models\UserPersonalData;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserPersonalData findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalData find($id, $columns = ['*'])
 * @method UserPersonalData first($columns = ['*'])
*/
class UserPersonalDataRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'personal_data_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalData::class;
    }
}
