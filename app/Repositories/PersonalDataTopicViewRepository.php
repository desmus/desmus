<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method PersonalDataTopicView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicView find($id, $columns = ['*'])
 * @method PersonalDataTopicView first($columns = ['*'])
*/
class PersonalDataTopicViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicView::class;
    }
}
