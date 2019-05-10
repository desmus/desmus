<?php

namespace App\Repositories;

use App\Models\JobTSPlaylistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPlaylistCreateRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method JobTSPlaylistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSPlaylistCreate find($id, $columns = ['*'])
 * @method JobTSPlaylistCreate first($columns = ['*'])
*/
class JobTSPlaylistCreateRepository extends BaseRepository
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
        return JobTSPlaylistCreate::class;
    }
}
