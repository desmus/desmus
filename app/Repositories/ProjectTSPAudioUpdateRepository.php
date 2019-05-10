<?php

namespace App\Repositories;

use App\Models\ProjectTSPAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPAudioUpdateRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:58 am UTC
 *
 * @method ProjectTSPAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPAudioUpdate find($id, $columns = ['*'])
 * @method ProjectTSPAudioUpdate first($columns = ['*'])
*/
class ProjectTSPAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSPAudioUpdate::class;
    }
}
