<?php

namespace App\Repositories;

use App\Models\UserJobTopicSectionC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTopicSectionCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserJobTopicSectionC findWithoutFail($id, $columns = ['*'])
 * @method UserJobTopicSectionC find($id, $columns = ['*'])
 * @method UserJobTopicSectionC first($columns = ['*'])
*/
class UserJobTopicSectionCRepository extends BaseRepository
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
        return UserJobTopicSectionC::class;
    }
}
