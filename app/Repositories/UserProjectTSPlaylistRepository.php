<?php

namespace App\Repositories;

use App\Models\UserProjectTSPlaylist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSPlaylistRepository
 * @package App\Repositories
 * @version June 30, 2018, 4:50 am UTC
 *
 * @method UserProjectTSPlaylist findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSPlaylist find($id, $columns = ['*'])
 * @method UserProjectTSPlaylist first($columns = ['*'])
*/
class UserProjectTSPlaylistRepository extends BaseRepository
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
        'p_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSPlaylist::class;
    }
}
