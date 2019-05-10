<?php

namespace App\Repositories;

use App\Models\CollegeTSPlaylistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPlaylistViewRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:06 pm UTC
 *
 * @method CollegeTSPlaylistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPlaylistView find($id, $columns = ['*'])
 * @method CollegeTSPlaylistView first($columns = ['*'])
*/
class CollegeTSPlaylistViewRepository extends BaseRepository
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
        return CollegeTSPlaylistView::class;
    }
}
