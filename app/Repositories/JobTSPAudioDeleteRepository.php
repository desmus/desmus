<?php

namespace App\Repositories;

use App\Models\JobTSPAudioDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPAudioDeleteRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method JobTSPAudioDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSPAudioDelete find($id, $columns = ['*'])
 * @method JobTSPAudioDelete first($columns = ['*'])
*/
class JobTSPAudioDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSPAudioDelete::class;
    }
}
