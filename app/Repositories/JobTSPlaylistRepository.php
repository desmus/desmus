<?php

namespace App\Repositories;

use App\Models\JobTSPlaylist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPlaylistRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method JobTSPlaylist findWithoutFail($id, $columns = ['*'])
 * @method JobTSPlaylist find($id, $columns = ['*'])
 * @method JobTSPlaylist first($columns = ['*'])
*/
class JobTSPlaylistRepository extends BaseRepository
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
        'j_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSPlaylist::class;
    }
}
