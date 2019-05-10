<?php

namespace App\Repositories;

use App\Models\ProjectTSPlaylistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPlaylistDeleteRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method ProjectTSPlaylistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPlaylistDelete find($id, $columns = ['*'])
 * @method ProjectTSPlaylistDelete first($columns = ['*'])
*/
class ProjectTSPlaylistDeleteRepository extends BaseRepository
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
        return ProjectTSPlaylistDelete::class;
    }
}
