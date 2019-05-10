<?php

namespace App\Repositories;

use App\Models\RecentActivityCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RecentActivityCreateRepository
 * @package App\Repositories
 * @version June 13, 2018, 6:23 pm UTC
 *
 * @method RecentActivityCreate findWithoutFail($id, $columns = ['*'])
 * @method RecentActivityCreate find($id, $columns = ['*'])
 * @method RecentActivityCreate first($columns = ['*'])
*/
class RecentActivityCreateRepository extends BaseRepository
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
        return RecentActivityCreate::class;
    }
}
