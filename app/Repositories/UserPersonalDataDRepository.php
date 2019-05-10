<?php

namespace App\Repositories;

use App\Models\UserPersonalDataD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:02 pm UTC
 *
 * @method UserPersonalDataD findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataD find($id, $columns = ['*'])
 * @method UserPersonalDataD first($columns = ['*'])
*/
class UserPersonalDataDRepository extends BaseRepository
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
        return UserPersonalDataD::class;
    }
}
