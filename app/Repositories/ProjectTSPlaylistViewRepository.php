<?php

namespace App\Repositories;

use App\Models\ProjectTSPlaylistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPlaylistViewRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method ProjectTSPlaylistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPlaylistView find($id, $columns = ['*'])
 * @method ProjectTSPlaylistView first($columns = ['*'])
*/
class ProjectTSPlaylistViewRepository extends BaseRepository
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
        return ProjectTSPlaylistView::class;
    }
}
