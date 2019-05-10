<?php

namespace App\Repositories;

use App\Models\PublicImageComment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicImageCommentRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicImageComment findWithoutFail($id, $columns = ['*'])
 * @method PublicImageComment find($id, $columns = ['*'])
 * @method PublicImageComment first($columns = ['*'])
*/
class PublicImageCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_image_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicImageComment::class;
    }
}
