<?php

namespace App\Repositories;

use App\Models\PublicAudioView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAudioViewRepository
 * @package App\Repositories
 * @version January 20, 2019, 3:46 am UTC
 *
 * @method PublicAudioView findWithoutFail($id, $columns = ['*'])
 * @method PublicAudioView find($id, $columns = ['*'])
 * @method PublicAudioView first($columns = ['*'])
*/
class PublicAudioViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'public_audio_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAudioView::class;
    }
}
