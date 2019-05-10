<?php

namespace App\Repositories;

use App\Models\JobTSPAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPAudioRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method JobTSPAudio findWithoutFail($id, $columns = ['*'])
 * @method JobTSPAudio find($id, $columns = ['*'])
 * @method JobTSPAudio first($columns = ['*'])
*/
class JobTSPAudioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'views_quantity',
        'updates_quantity',
        'status',
        'j_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSPAudio::class;
    }
}
