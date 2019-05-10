<?php

namespace App\Repositories;

use App\Models\UCTSPlaylistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UCTSPlaylistUpdateRepository
 * @package App\Repositories
 * @version June 30, 2018, 4:50 am UTC
 *
 * @method UCTSPlaylistUpdate findWithoutFail($id, $columns = ['*'])
 * @method UCTSPlaylistUpdate find($id, $columns = ['*'])
 * @method UCTSPlaylistUpdate first($columns = ['*'])
*/
class UCTSPlaylistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UCTSPlaylistUpdate::class;
    }
}
