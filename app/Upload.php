<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Upload extends Model {
    public $primaryKey = 'id_upload';

    // relationship, method tells us that a single upload belongs to a user.
    public function user() {
        return $this->belongsTo('App\User');
    }
}
