<?php

namespace App\Repositories;

use App\Models\SharedProfileAudioC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileAudioCRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileAudioC findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileAudioC find($id, $columns = ['*'])
 * @method SharedProfileAudioC first($columns = ['*'])
*/
class SharedProfileAudioCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_a_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileAudioC::class;
    }
}
