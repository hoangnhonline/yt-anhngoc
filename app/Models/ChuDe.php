<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ChuDe extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chu_de';

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ten'
    ];

    public function thuocTinh()
    {
        return $this->hasMany('App\Models\ThuocTinhChuDe', 'id_chude');
    }
}