<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSP;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSPRepository
 * @package App\Repositories
 * @version June 30, 2018, 5:48 am UTC
 *
 * @method UserPersonalDataTSP findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSP find($id, $columns = ['*'])
 * @method UserPersonalDataTSP first($columns = ['*'])
*/
class UserPersonalDataTSPRepository extends BaseRepository
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
        'p_d_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSP::class;
    }
}
