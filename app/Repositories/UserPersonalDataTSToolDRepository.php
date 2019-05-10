<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSToolD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSToolDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:07 pm UTC
 *
 * @method UserPersonalDataTSToolD findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSToolD find($id, $columns = ['*'])
 * @method UserPersonalDataTSToolD first($columns = ['*'])
*/
class UserPersonalDataTSToolDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSToolD::class;
    }
}
