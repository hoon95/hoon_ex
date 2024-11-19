<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table      = 'file_table';        // 사용할 테이블 명
    protected $primaryKey = 'fid';
    // protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['bid', 'userid', 'filename', 'regdate', 'status' , 'memoid' , 'type'];     // PK 설정 불가

}