<?php

namespace App\Repositories;

use App\Models\ContactSocialUpdates;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactSocialUpdatesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:21 pm UTC
 *
 * @method ContactSocialUpdates findWithoutFail($id, $columns = ['*'])
 * @method ContactSocialUpdates find($id, $columns = ['*'])
 * @method ContactSocialUpdates first($columns = ['*'])
*/
class ContactSocialUpdatesRepository extends BaseRepository
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
        return ContactSocialUpdates::class;
    }
}
