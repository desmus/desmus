<?php

namespace App\Repositories;

use App\Models\ContactSocialDeletes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactSocialDeletesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:21 pm UTC
 *
 * @method ContactSocialDeletes findWithoutFail($id, $columns = ['*'])
 * @method ContactSocialDeletes find($id, $columns = ['*'])
 * @method ContactSocialDeletes first($columns = ['*'])
*/
class ContactSocialDeletesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_social_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactSocialDeletes::class;
    }
}
