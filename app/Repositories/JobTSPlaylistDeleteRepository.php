<?php

namespace App\Repositories;

use App\Models\JobTSPlaylistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPlaylistDeleteRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method JobTSPlaylistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSPlaylistDelete find($id, $columns = ['*'])
 * @method JobTSPlaylistDelete first($columns = ['*'])
*/
class JobTSPlaylistDeleteRepository extends BaseRepository
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
        return JobTSPlaylistDelete::class;
    }
}
