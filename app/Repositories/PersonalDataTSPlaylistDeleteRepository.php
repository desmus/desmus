<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPlaylistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPlaylistDeleteRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:43 pm UTC
 *
 * @method PersonalDataTSPlaylistDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPlaylistDelete find($id, $columns = ['*'])
 * @method PersonalDataTSPlaylistDelete first($columns = ['*'])
*/
class PersonalDataTSPlaylistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSPlaylistDelete::class;
    }
}
