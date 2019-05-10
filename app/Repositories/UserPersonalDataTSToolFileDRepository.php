<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSToolFileD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSToolFileDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:09 pm UTC
 *
 * @method UserPersonalDataTSToolFileD findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSToolFileD find($id, $columns = ['*'])
 * @method UserPersonalDataTSToolFileD first($columns = ['*'])
*/
class UserPersonalDataTSToolFileDRepository extends BaseRepository
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
        return UserPersonalDataTSToolFileD::class;
    }
}
