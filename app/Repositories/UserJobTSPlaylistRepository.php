<?php

namespace App\Repositories;

use App\Models\UserJobTSPlaylist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSPlaylistRepository
 * @package App\Repositories
 * @version June 30, 2018, 4:50 am UTC
 *
 * @method UserJobTSPlaylist findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSPlaylist find($id, $columns = ['*'])
 * @method UserJobTSPlaylist first($columns = ['*'])
*/
class UserJobTSPlaylistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'j_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSPlaylist::class;
    }
}
