<?php

namespace App\Repositories;

use App\Models\CollegeView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method CollegeView findWithoutFail($id, $columns = ['*'])
 * @method CollegeView find($id, $columns = ['*'])
 * @method CollegeView first($columns = ['*'])
*/
class CollegeViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeView::class;
    }
}
