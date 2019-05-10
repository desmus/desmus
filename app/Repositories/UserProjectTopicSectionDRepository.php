<?php

namespace App\Repositories;

use App\Models\UserProjectTopicSectionD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTopicSectionDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:03 pm UTC
 *
 * @method UserProjectTopicSectionD findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTopicSectionD find($id, $columns = ['*'])
 * @method UserProjectTopicSectionD first($columns = ['*'])
*/
class UserProjectTopicSectionDRepository extends BaseRepository
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
        return UserProjectTopicSectionD::class;
    }
}
