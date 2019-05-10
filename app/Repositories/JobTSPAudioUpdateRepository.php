<?php

namespace App\Repositories;

use App\Models\JobTSPAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPAudioUpdateRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method JobTSPAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSPAudioUpdate find($id, $columns = ['*'])
 * @method JobTSPAudioUpdate first($columns = ['*'])
*/
class JobTSPAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSPAudioUpdate::class;
    }
}
