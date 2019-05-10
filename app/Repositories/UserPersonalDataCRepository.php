<?php

namespace App\Repositories;

use App\Models\UserPersonalDataC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserPersonalDataC findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataC find($id, $columns = ['*'])
 * @method UserPersonalDataC first($columns = ['*'])
*/
class UserPersonalDataCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataC::class;
    }
}
