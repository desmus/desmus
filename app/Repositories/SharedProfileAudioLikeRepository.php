<?php

namespace App\Repositories;

use App\Models\SharedProfileAudioLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileAudioLikeRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileAudioLike findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileAudioLike find($id, $columns = ['*'])
 * @method SharedProfileAudioLike first($columns = ['*'])
*/
class SharedProfileAudioLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return SharedProfileAudioLike::class;
    }
}
