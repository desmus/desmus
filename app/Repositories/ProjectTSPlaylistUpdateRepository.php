<?php

namespace App\Repositories;

use App\Models\ProjectTSPlaylistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPlaylistUpdateRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method ProjectTSPlaylistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPlaylistUpdate find($id, $columns = ['*'])
 * @method ProjectTSPlaylistUpdate first($columns = ['*'])
*/
class ProjectTSPlaylistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSPlaylistUpdate::class;
    }
}
