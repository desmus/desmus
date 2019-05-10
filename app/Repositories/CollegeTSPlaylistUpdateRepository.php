<?php

namespace App\Repositories;

use App\Models\CollegeTSPlaylistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPlaylistUpdateRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:06 pm UTC
 *
 * @method CollegeTSPlaylistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPlaylistUpdate find($id, $columns = ['*'])
 * @method CollegeTSPlaylistUpdate first($columns = ['*'])
*/
class CollegeTSPlaylistUpdateRepository extends BaseRepository
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
        return CollegeTSPlaylistUpdate::class;
    }
}
