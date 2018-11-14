<?php

namespace App\Repositories;

use App\Models\demo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class demoRepository
 * @package App\Repositories
 * @version July 9, 2018, 3:58 pm UTC
 *
 * @method demo findWithoutFail($id, $columns = ['*'])
 * @method demo find($id, $columns = ['*'])
 * @method demo first($columns = ['*'])
*/
class demoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'website',
        'company_name',
        'product_name',
        'product_url',
        'callback_url',
        'qrcode_path',
        'amount',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return demo::class;
    }
}
