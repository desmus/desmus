<?php

namespace App\Repositories;

use App\Models\ContactWebView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactWebViewRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:22 pm UTC
 *
 * @method ContactWebView findWithoutFail($id, $columns = ['*'])
 * @method ContactWebView find($id, $columns = ['*'])
 * @method ContactWebView first($columns = ['*'])
*/
class ContactWebViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_web_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactWebView::class;
    }
}
