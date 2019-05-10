<?php

namespace App\Repositories;

use App\Models\JobTSPlaylistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPlaylistViewRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method JobTSPlaylistView findWithoutFail($id, $columns = ['*'])
 * @method JobTSPlaylistView find($id, $columns = ['*'])
 * @method JobTSPlaylistView first($columns = ['*'])
*/
class JobTSPlaylistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSPlaylistView::class;
    }
}
