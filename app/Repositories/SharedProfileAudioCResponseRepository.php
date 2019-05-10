<?php

namespace App\Repositories;

use App\Models\SharedProfileAudioCResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileAudioCResponseRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileAudioCResponse findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileAudioCResponse find($id, $columns = ['*'])
 * @method SharedProfileAudioCResponse first($columns = ['*'])
*/
class SharedProfileAudioCResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_a_c_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileAudioCResponse::class;
    }
}
