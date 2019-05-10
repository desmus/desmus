<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSToolC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSToolCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserPersonalDataTSToolC findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSToolC find($id, $columns = ['*'])
 * @method UserPersonalDataTSToolC first($columns = ['*'])
*/
class UserPersonalDataTSToolCRepository extends BaseRepository
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
        return UserPersonalDataTSToolC::class;
    }
}
