<?php

namespace App\Repositories;

use App\Models\UserJobTopicSectionU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTopicSectionURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserJobTopicSectionU findWithoutFail($id, $columns = ['*'])
 * @method UserJobTopicSectionU find($id, $columns = ['*'])
 * @method UserJobTopicSectionU first($columns = ['*'])
*/
class UserJobTopicSectionURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTopicSectionU::class;
    }
}
