<?php

namespace App\Repositories;

use App\Models\CollegeTSPlaylistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPlaylistDeleteRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:06 pm UTC
 *
 * @method CollegeTSPlaylistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPlaylistDelete find($id, $columns = ['*'])
 * @method CollegeTSPlaylistDelete first($columns = ['*'])
*/
class CollegeTSPlaylistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSPlaylistDelete::class;
    }
}
