<?php

namespace App\Repositories;

use App\Models\ProjectTSPlaylistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPlaylistCreateRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method ProjectTSPlaylistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPlaylistCreate find($id, $columns = ['*'])
 * @method ProjectTSPlaylistCreate first($columns = ['*'])
*/
class ProjectTSPlaylistCreateRepository extends BaseRepository
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
        return ProjectTSPlaylistCreate::class;
    }
}
