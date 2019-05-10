<?php

namespace App\Repositories;

use App\Models\ProjectTSPlaylist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPlaylistRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method ProjectTSPlaylist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPlaylist find($id, $columns = ['*'])
 * @method ProjectTSPlaylist first($columns = ['*'])
*/
class ProjectTSPlaylistRepository extends BaseRepository
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
        'p_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSPlaylist::class;
    }
}
