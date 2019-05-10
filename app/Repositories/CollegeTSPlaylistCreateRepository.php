<?php

namespace App\Repositories;

use App\Models\CollegeTSPlaylistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPlaylistCreateRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:06 pm UTC
 *
 * @method CollegeTSPlaylistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPlaylistCreate find($id, $columns = ['*'])
 * @method CollegeTSPlaylistCreate first($columns = ['*'])
*/
class CollegeTSPlaylistCreateRepository extends BaseRepository
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
        return CollegeTSPlaylistCreate::class;
    }
}
