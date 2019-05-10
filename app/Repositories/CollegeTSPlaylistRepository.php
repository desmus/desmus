<?php

namespace App\Repositories;

use App\Models\CollegeTSPlaylist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPlaylistRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:06 pm UTC
 *
 * @method CollegeTSPlaylist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPlaylist find($id, $columns = ['*'])
 * @method CollegeTSPlaylist first($columns = ['*'])
*/
class CollegeTSPlaylistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'c_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSPlaylist::class;
    }
}
