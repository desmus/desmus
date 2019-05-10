<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPlaylistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPlaylistCreateRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:08 pm UTC
 *
 * @method PersonalDataTSPlaylistCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPlaylistCreate find($id, $columns = ['*'])
 * @method PersonalDataTSPlaylistCreate first($columns = ['*'])
*/
class PersonalDataTSPlaylistCreateRepository extends BaseRepository
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
        return PersonalDataTSPlaylistCreate::class;
    }
}
