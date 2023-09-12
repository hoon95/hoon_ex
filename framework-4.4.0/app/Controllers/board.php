<?php

namespace App\Controllers;

use App\Models\BoardModel;      // 사용할 모델을 로드
use App\Models\FileModel;

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
        // $db = db_connect();
        // $subject = $this->request->getVar('subject');
        // $content = $this->request->getVar('content');
        // $myTime = new Time('now', 'Asia/Seoul');
        // $myTime ->modify('+9 hours');
        // $formattedTime = $myTime -> toDateTimeString();

        // $sql = "INSERT INTO board (userid, subject, content, regdate) VALUES('test', ?,?,?)";
        // $result = $db -> query($sql,[$subject, $content, $formattedTime]);
        $boardModel = new BoardModel();
        $fileModel = new FileModel();

        $myTime = new Time('now', 'Asia/Seoul');
        $myTime ->modify('+9 hours');     

        $data = [
            'userid' => $_SESSION['userid'],
            'subject' => $this->request->getVar('subject'),
            'content' => $this->request->getVar('content'),
            'regdate' => $myTime -> toDateTimeString()
        ];
        
        $bid = $this->request->getVar('bid');
        $file = $this->request->getFile('upfile');

        $db = db_connect();     // 새 글 등록 시 자동으로 file_table의 fid 넣을 id 생성하기 위해

        if($file->getName()){
            $filename = $file->getName();
            $newFile = $file->getRandomeName();
            $filepath = $file->store('board/', $newName);
        }

        if($bid){       // 수정
            $boardModel ->update($bid, $data);
            return $this->response ->redirect(site_url('/boardview/'.$bid)); //쿼리성공후 board 페이지로 이동
        }else{          // 신규 글 등록
            $boardModel ->insert($data);

            $FileModel -> insert($fileData);
            return $this->response ->redirect(site_url('/board')); //쿼리성공후 board 페이지로 이동
        }


    }
    public function modify($bid = null){
        // 레거시 문법
        // $db = db_connect();
        // $sql = "SELECT * FROM board WHERE bid={$bid}";
        // $result = $db->query($sql);
        // if($_SESSION['userid'] == $result->getRow()->userid){
        //     $data['view'] = $result->getRow();
        //     return render('board_write', $data);
        // }else{
        //     echo "<script>
        //         alert('본인 글만 수정할 수 있습니다);
        //         location.href='/board';                
        //     </script>";
        // }

        // 모델 활용 문법
        $boardModel = new BoardModel(); 
        $board = $boardModel->find($bid);

        if($_SESSION['userid'] == $board->userid){
            $data['view'] = $board;
            return render('board_write', $data);
        }else{
            return redirect()->to('/board')->with('alert','본인 글만 수정할 수 있습니다');
        }

    }
    public function delete($bid = null){
        $boardModel = new BoardModel();
        $board = $boardModel->find($bid);

        if($_SESSION['userid'] == $board->userid){
            $boardModel->delete($bid);
            return redirect()->to('/board');
        }else{
            return redirect()->to('/board')->with('alert','본인 글만 삭제할 수 있습니다');
        }
    }
}
