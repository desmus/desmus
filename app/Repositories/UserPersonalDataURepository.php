<?php

namespace App\Repositories;

use App\Models\UserPersonalDataU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserPersonalDataU findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataU find($id, $columns = ['*'])
 * @method UserPersonalDataU first($columns = ['*'])
*/
class UserPersonalDataURepository extends BaseRepository
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
        return UserPersonalDataU::class;
    }
}
