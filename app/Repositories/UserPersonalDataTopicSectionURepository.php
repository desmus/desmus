<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTopicSectionU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTopicSectionURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserPersonalDataTopicSectionU findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTopicSectionU find($id, $columns = ['*'])
 * @method UserPersonalDataTopicSectionU first($columns = ['*'])
*/
class UserPersonalDataTopicSectionURepository extends BaseRepository
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
        return UserPersonalDataTopicSectionU::class;
    }
}
