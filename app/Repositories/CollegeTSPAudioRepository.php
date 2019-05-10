<?php

namespace App\Repositories;

use App\Models\CollegeTSPAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPAudioRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:56 am UTC
 *
 * @method CollegeTSPAudio findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPAudio find($id, $columns = ['*'])
 * @method CollegeTSPAudio first($columns = ['*'])
*/
class CollegeTSPAudioRepository extends BaseRepository
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
        'c_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSPAudio::class;
    }
}
