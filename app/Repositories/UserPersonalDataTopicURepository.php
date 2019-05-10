<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTopicU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTopicURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserPersonalDataTopicU findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTopicU find($id, $columns = ['*'])
 * @method UserPersonalDataTopicU first($columns = ['*'])
*/
class UserPersonalDataTopicURepository extends BaseRepository
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
        return UserPersonalDataTopicU::class;
    }
}
