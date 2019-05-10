<?php

namespace App\Repositories;

use App\Models\RecentActivityUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RecentActivityUpdateRepository
 * @package App\Repositories
 * @version June 13, 2018, 6:24 pm UTC
 *
 * @method RecentActivityUpdate findWithoutFail($id, $columns = ['*'])
 * @method RecentActivityUpdate find($id, $columns = ['*'])
 * @method RecentActivityUpdate first($columns = ['*'])
*/
class RecentActivityUpdateRepository extends BaseRepository
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
        return RecentActivityUpdate::class;
    }
}
