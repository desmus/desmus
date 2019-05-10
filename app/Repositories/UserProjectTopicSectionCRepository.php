<?php

namespace App\Repositories;

use App\Models\UserProjectTopicSectionC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTopicSectionCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserProjectTopicSectionC findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTopicSectionC find($id, $columns = ['*'])
 * @method UserProjectTopicSectionC first($columns = ['*'])
*/
class UserProjectTopicSectionCRepository extends BaseRepository
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
        return UserProjectTopicSectionC::class;
    }
}
