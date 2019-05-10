<?php

namespace App\Repositories;

use App\Models\RecentActivityView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RecentActivityViewRepository
 * @package App\Repositories
 * @version June 13, 2018, 6:24 pm UTC
 *
 * @method RecentActivityView findWithoutFail($id, $columns = ['*'])
 * @method RecentActivityView find($id, $columns = ['*'])
 * @method RecentActivityView first($columns = ['*'])
*/
class RecentActivityViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'recent_activity_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RecentActivityView::class;
    }
}
