<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTopicSectionD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTopicSectionDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:03 pm UTC
 *
 * @method UserPersonalDataTopicSectionD findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTopicSectionD find($id, $columns = ['*'])
 * @method UserPersonalDataTopicSectionD first($columns = ['*'])
*/
class UserPersonalDataTopicSectionDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTopicSectionD::class;
    }
}
