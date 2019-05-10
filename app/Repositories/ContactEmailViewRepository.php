<?php

namespace App\Repositories;

use App\Models\ContactEmailView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactEmailViewRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:21 pm UTC
 *
 * @method ContactEmailView findWithoutFail($id, $columns = ['*'])
 * @method ContactEmailView find($id, $columns = ['*'])
 * @method ContactEmailView first($columns = ['*'])
*/
class ContactEmailViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_email_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactEmailView::class;
    }
}
