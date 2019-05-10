<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTopicSectionC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTopicSectionCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserPersonalDataTopicSectionC findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTopicSectionC find($id, $columns = ['*'])
 * @method UserPersonalDataTopicSectionC first($columns = ['*'])
*/
class UserPersonalDataTopicSectionCRepository extends BaseRepository
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
        return UserPersonalDataTopicSectionC::class;
    }
}
