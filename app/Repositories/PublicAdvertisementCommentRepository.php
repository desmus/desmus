<?php

namespace App\Repositories;

use App\Models\PublicAdvertisementComment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAdvertisementCommentRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:24 pm UTC
 *
 * @method PublicAdvertisementComment findWithoutFail($id, $columns = ['*'])
 * @method PublicAdvertisementComment find($id, $columns = ['*'])
 * @method PublicAdvertisementComment first($columns = ['*'])
*/
class PublicAdvertisementCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_advertisement_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAdvertisementComment::class;
    }
}
