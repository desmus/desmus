<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSToolFileC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSToolFileCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:58 pm UTC
 *
 * @method UserPersonalDataTSToolFileC findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSToolFileC find($id, $columns = ['*'])
 * @method UserPersonalDataTSToolFileC first($columns = ['*'])
*/
class UserPersonalDataTSToolFileCRepository extends BaseRepository
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
        return UserPersonalDataTSToolFileC::class;
    }
}
