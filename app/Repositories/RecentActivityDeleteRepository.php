<?php

namespace App\Repositories;

use App\Models\RecentActivityDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RecentActivityDeleteRepository
 * @package App\Repositories
 * @version June 13, 2018, 6:24 pm UTC
 *
 * @method RecentActivityDelete findWithoutFail($id, $columns = ['*'])
 * @method RecentActivityDelete find($id, $columns = ['*'])
 * @method RecentActivityDelete first($columns = ['*'])
*/
class RecentActivityDeleteRepository extends BaseRepository
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
        return RecentActivityDelete::class;
    }
}
