<?php

namespace App\Repositories;

use App\Models\CollegeTSPAudioCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPAudioCreateRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:56 am UTC
 *
 * @method CollegeTSPAudioCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPAudioCreate find($id, $columns = ['*'])
 * @method CollegeTSPAudioCreate first($columns = ['*'])
*/
class CollegeTSPAudioCreateRepository extends BaseRepository
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
        return CollegeTSPAudioCreate::class;
    }
}
