<?php

namespace App\Repositories;

use App\Models\CollegeTopic;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method CollegeTopic findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopic find($id, $columns = ['*'])
 * @method CollegeTopic first($columns = ['*'])
*/
class CollegeTopicRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'specific_info',
        'views_quantity',
        'updates_quantity',
        'status',
        'college_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopic::class;
    }
}
