<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MailUpload extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mail_upload';

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
        'email', 
        'password',
        'status' 
    ];
    public function videos()
    {
        return $this->hasMany('App\Models\LinkVideo', 'id_mail');
    }
}