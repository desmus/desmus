<?php

namespace App\Repositories;

use App\Models\ContactSocial;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactSocialRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:21 pm UTC
 *
 * @method ContactSocial findWithoutFail($id, $columns = ['*'])
 * @method ContactSocial find($id, $columns = ['*'])
 * @method ContactSocial first($columns = ['*'])
*/
class ContactSocialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'link',
        'contact_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactSocial::class;
    }
}
