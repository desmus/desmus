<?php

namespace App\Repositories;

use App\Models\ContactSocialCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactSocialCreateRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:21 pm UTC
 *
 * @method ContactSocialCreate findWithoutFail($id, $columns = ['*'])
 * @method ContactSocialCreate find($id, $columns = ['*'])
 * @method ContactSocialCreate first($columns = ['*'])
*/
class ContactSocialCreateRepository extends BaseRepository
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
        return ContactSocialCreate::class;
    }
}
