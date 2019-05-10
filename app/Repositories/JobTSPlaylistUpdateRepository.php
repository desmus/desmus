<?php

namespace App\Repositories;

use App\Models\JobTSPlaylistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPlaylistUpdateRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method JobTSPlaylistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSPlaylistUpdate find($id, $columns = ['*'])
 * @method JobTSPlaylistUpdate first($columns = ['*'])
*/
class JobTSPlaylistUpdateRepository extends BaseRepository
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
        return JobTSPlaylistUpdate::class;
    }
}
