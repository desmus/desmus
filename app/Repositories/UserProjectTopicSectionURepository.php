<?php

namespace App\Repositories;

use App\Models\UserProjectTopicSectionU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTopicSectionURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserProjectTopicSectionU findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTopicSectionU find($id, $columns = ['*'])
 * @method UserProjectTopicSectionU first($columns = ['*'])
*/
class UserProjectTopicSectionURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTopicSectionU::class;
    }
}
