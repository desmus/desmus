<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSToolFileU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSToolFileURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:02 pm UTC
 *
 * @method UserPersonalDataTSToolFileU findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSToolFileU find($id, $columns = ['*'])
 * @method UserPersonalDataTSToolFileU first($columns = ['*'])
*/
class UserPersonalDataTSToolFileURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSToolFileU::class;
    }
}
