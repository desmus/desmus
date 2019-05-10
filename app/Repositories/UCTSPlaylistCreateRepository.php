<?php

namespace App\Repositories;

use App\Models\UCTSPlaylistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UCTSPlaylistCreateRepository
 * @package App\Repositories
 * @version June 30, 2018, 4:50 am UTC
 *
 * @method UCTSPlaylistCreate findWithoutFail($id, $columns = ['*'])
 * @method UCTSPlaylistCreate find($id, $columns = ['*'])
 * @method UCTSPlaylistCreate first($columns = ['*'])
*/
class UCTSPlaylistCreateRepository extends BaseRepository
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
        return UCTSPlaylistCreate::class;
    }
}
