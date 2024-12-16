<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    use HasFactory;
    protected $table        = "buku";
    protected $primaryKey   = "id_buku";

    public $incrementing = true; // Menentukan bahwa primary key auto increment
    protected $keyType = 'int'; // Jenis data primary key

    protected $fillable     = ['kode_buku','judul','pengarang','kategori', 'user_id'];
}
