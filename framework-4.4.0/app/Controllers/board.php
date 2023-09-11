<?php

namespace App\Controllers;
use App\Models\BoardModel;      // 사용할 모델을 로드
use CodeIgniter\I18n\Time;      // 날짜 라이브러리
class Board extends BaseController
{
    public function list(): string
    {
        // 레거시 문법(모델 사용 X)
        // return view('board_list');
        // $db = db_connect();
        // $sql = "SELECT * FROM board ORDER BY bid DESC";
        // $result = $db->query($sql);
        // $data['list'] = $result->getResult();       // fetch_object 결과를 배열에 담기


        // 모델 문법
        $boardModel = new BoardModel();     // 레거시 문법의 $db, $result 실행 결과와 동일
        $data['list'] = $boardModel -> orderBy('bid', 'desc') -> findAll();

        return render('board_list', $data);
    }
    public function write()
    {
        if(!isset($_SESSION['userid'])){
            // 레거시 문법
            // echo "<script>alert('로그인하세요'); location.href='/login/';</script>";

            // CI4 문법
            return redirect()->to('/login')->with('alert','로그인하세요');
        }
        return render('board_write');
    }
    public function view($bid = null)
    {
        // 레거시 문법
        // $db = db_connect();
        // $sql = "SELECT * FROM board WHERE bid={$bid}";
        // $result = $db->query($sql);
        // $data['view'] = $result->getRow();      // getRow() : 일치하는 행 하나만 가져오는 문법(CI4)

        // 모델 문법
        $boardModel = new BoardModel();     // 레거시 문법의 $db, $result 실행 결과와 동일
        $data['view'] = $boardModel -> where('bid', $bid) -> first();

        return render('board_view', $data);
    }
    public function save()
    {
        $db = db_connect();
        $subject = $this->request->getVar('subject');
        $content = $this->request->getVar('content');
        $myTime = new Time('now', 'Asia/Seoul');
        $myTime -> modify('+9 hours');
        $formattedTime = $myTime -> toDateTimeString();

        $sql = "INSERT INTO board (userid, subject, content, regdate) VALUES ('test', '{$subject}', '{$content}', '{$formattedTime}')";
        $result = $db -> query($sql);
        return $this->response->redirect(site_url('/board'));   // 쿼리 성공 후 board 페이지로 이동
    }
}
