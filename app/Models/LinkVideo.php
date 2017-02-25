<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LinkVideo extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'link_video';

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stt', 
        'link', 
        'name', 
        'id_chude', 
        'str_id_thuoctinh', 
        'id_mail',
        'user_id',
        'duration',
        'created_user',
        'updated_user',
        'notes'
    ];
}