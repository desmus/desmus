<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTopicC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTopicCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserPersonalDataTopicC findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTopicC find($id, $columns = ['*'])
 * @method UserPersonalDataTopicC first($columns = ['*'])
*/
class UserPersonalDataTopicCRepository extends BaseRepository
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
        return UserPersonalDataTopicC::class;
    }
}
