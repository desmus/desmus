<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTopicD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTopicDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:03 pm UTC
 *
 * @method UserPersonalDataTopicD findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTopicD find($id, $columns = ['*'])
 * @method UserPersonalDataTopicD first($columns = ['*'])
*/
class UserPersonalDataTopicDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTopicD::class;
    }
}
