<?php

namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model
{
    protected $table      = 'board';        // 사용할 테이블 명
    protected $primaryKey = 'bid';
    // protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['userid', 'subject', 'content', 'regdate'];     // PK 설정 불가

}