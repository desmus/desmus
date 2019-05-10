<?php

namespace App\Repositories;

use App\Models\UCTSPlaylistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UCTSPlaylistDeleteRepository
 * @package App\Repositories
 * @version June 30, 2018, 4:51 am UTC
 *
 * @method UCTSPlaylistDelete findWithoutFail($id, $columns = ['*'])
 * @method UCTSPlaylistDelete find($id, $columns = ['*'])
 * @method UCTSPlaylistDelete first($columns = ['*'])
*/
class UCTSPlaylistDeleteRepository extends BaseRepository
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
        return UCTSPlaylistDelete::class;
    }
}
