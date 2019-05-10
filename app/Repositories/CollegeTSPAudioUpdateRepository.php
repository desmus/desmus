<?php

namespace App\Repositories;

use App\Models\CollegeTSPAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPAudioUpdateRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method CollegeTSPAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPAudioUpdate find($id, $columns = ['*'])
 * @method CollegeTSPAudioUpdate first($columns = ['*'])
*/
class CollegeTSPAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSPAudioUpdate::class;
    }
}
