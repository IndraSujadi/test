<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //fillable yang boleh di isi
    // guarded yang gk boleh di isi
    protected $fillable = ['nama', 'nim', 'email', 'jurusan'];
    //
}
