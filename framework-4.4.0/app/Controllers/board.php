<?php

namespace App\Controllers;

class Board extends BaseController
{
    public function list(): string
    {
        $db = db_connect();
        $sql = "SELECT * FROM board ORDER BY bid DESC";
        $result = $db->query($sql);
        $data['list'] = $result->getResult();       // fetch_object 결과를 배열에 담기
        return render('board_list', $data);
    }
    public function write(): string
    {
        return render('board_write');
    }
}
