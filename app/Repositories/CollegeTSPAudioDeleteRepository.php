<?php

namespace App\Repositories;

use App\Models\CollegeTSPAudioDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPAudioDeleteRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method CollegeTSPAudioDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPAudioDelete find($id, $columns = ['*'])
 * @method CollegeTSPAudioDelete first($columns = ['*'])
*/
class CollegeTSPAudioDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSPAudioDelete::class;
    }
}
