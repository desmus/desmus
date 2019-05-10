<?php

namespace App\Repositories;

use App\Models\SharedProfileAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileAudioUpdateRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:30 pm UTC
 *
 * @method SharedProfileAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileAudioUpdate find($id, $columns = ['*'])
 * @method SharedProfileAudioUpdate first($columns = ['*'])
*/
class SharedProfileAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        's_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileAudioUpdate::class;
    }
}
