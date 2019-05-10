<?php

namespace App\Repositories;

use App\Models\UserCollegeTSPlaylist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSPlaylistRepository
 * @package App\Repositories
 * @version June 30, 2018, 4:49 am UTC
 *
 * @method UserCollegeTSPlaylist findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSPlaylist find($id, $columns = ['*'])
 * @method UserCollegeTSPlaylist first($columns = ['*'])
*/
class UserCollegeTSPlaylistRepository extends BaseRepository
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
        'c_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSPlaylist::class;
    }
}
