<?php

namespace App\Repositories;

use App\Models\ContactSocialView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactSocialViewRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:21 pm UTC
 *
 * @method ContactSocialView findWithoutFail($id, $columns = ['*'])
 * @method ContactSocialView find($id, $columns = ['*'])
 * @method ContactSocialView first($columns = ['*'])
*/
class ContactSocialViewRepository extends BaseRepository
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
        return ContactSocialView::class;
    }
}
