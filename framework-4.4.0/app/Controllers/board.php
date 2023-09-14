<?php

namespace App\Controllers;
use App\Models\BoardModel; //사용할 모델을 로드
use App\Models\FileModel; //사용할 모델을 로드
use CodeIgniter\I18n\Time;
use CodeIgniter\Pager\Pager;

class Board extends BaseController
{
    public function list(): string
    {
        // return view('board_list');
        // $db = db_connect();
        // $sql = "SELECT * from board order by bid desc";
        // $result = $db -> query($sql);
        // $data['list'] = $result->getResult(); //fetch_object 글 결과 배열에 담기
        $boardModel = new BoardModel();
        $page = $this -> request -> getVar('page') ?? 1;
        $perPage = 3;
        $startLimit = ($page-1) * $perPage;

        $list = $boardModel -> select('*') -> where('1=1') -> orderBy('bid', 'desc') -> limit($perPage, $startLimit)  -> findAll($perPage, $startLimit);

        $total = $boardModel -> countAllResults();

        $pager = service('pager');
        $pager_links = $pager->makeLinks($page, $perPage, $total, 'default_full');

        $data = [
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'pager_links' => $pager_links,
            'list' => $list
        ];

        return render('board_list' ,$data);
    }
    public function write()
    {
        if(!isset($_SESSION['userid'])){
            //echo "<script>alert('로그인하세요'); location.href='/login/'</script>";
            return redirect()->to('/login')->with('alert','로그인하세요');           
        }
        // return view('board_write');
        return render('board_write');
    }
    public function view($bid = null)
    {
        // $db = db_connect();
        // $sql = "SELECT * from board where bid={$bid}";
        // $result = $db -> query($sql);
        // $data['view'] = $result->getRow();
        $boardModel = new BoardModel();
        $data['view'] = $boardModel -> where('bid', $bid)->first();

        $fileModel = new FileModel();
        $data['file_view'] = $fileModel -> where('type', 'board') -> where('bid', $bid)->findAll();

        // $data['view'] = $boardModel -> select('board.*,GROUP_CONCAT(file_table.filename) as fs')
        //                             -> join('file_table','file_table.bid=board.bid', 'left')
        //                             -> where('file_table.type','board')
        //                             -> where('board.bid', $bid)
        //                             -> where('file_table.bid', $bid)
        //                             -> first();

        return render('board_view', $data);

    }
    public function save()
    {

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
        // $file = $this->request->getFile('upfile'); 
        $files = $this->request->getFileMultiple('upfile');  //다중 파일 정보 조회.
        $filepath = array(); //새 배열 생성, 여러파일명의 정보를 

        $db = db_connect(); //새글 등록시 자동으로  file_table의 fid넣을 id생성하기 위해

        foreach($files as $file){
            if($file->getName()){
                $filename=$file->getName();
                $newName = $file ->getRandomName();
                $filepath[] = $file->store('board/', $newName);
            }
        }

        if($bid){ //수정
            $boardModel ->update($bid,$data);        
            // $insertid= $db->insertID();      //board테이블에 글등록후 생기는 고유id를 생성

            foreach($filepath as $fp){
                $fileData=[
                    'bid' => $bid,
                    'userid' => $_SESSION['userid'],
                    'filename' => $fp,
                    'type' => 'board'
                ];
                $fileModel ->insert($fileData);
            }    
            return $this->response ->redirect(site_url('/boardview/'.$bid)); //쿼리성공후 board 페이지로 이동
        }else{ //신규 글 등록
            $boardModel ->insert($data); 
            $insertid= $db->insertID();//board테이블에 글등록후 생기는 고유id를 생성

            foreach($filepath as $fp){
                $fileData=[
                    'bid' => $insertid,
                    'userid' => $_SESSION['userid'],
                    'filename' => $fp,
                    'type' => 'board'
                ];
                $fileModel ->insert($fileData);
            }    
            return $this->response ->redirect(site_url('/board')); //쿼리성공후 board 페이지로 이동
        }        
    } 
    public function modify($bid = null)
    {
         $boardModel = new BoardModel();
        $board = $boardModel->find($bid);

        //모든 첨부파일 삭제 - 시작
        $fileModel = new FileModel();
        $files = $fileModel -> where('type', 'board') -> where('bid', $bid)->findAll();

        foreach($files as $file){
            unlink('uploads/'.$file->filename);//서버에서 해당파일 삭제
        }        
        $fileModel -> where('type', 'board') -> where('bid', $bid)->delete();//테이블에서 행 삭제
        //모든 첨부파일 삭제 - 끝

        if($_SESSION['userid'] == $board->userid){
            $data['view']= $board;
            return render('board_write',$data);
        } else {
            return redirect()->to('/board')->with('alert','본인글만 수정할 수 있습니다.');  
        }

    }   
    public function delete($bid = null)
    {
        $boardModel = new BoardModel();
        $board = $boardModel->find($bid);

        $fileModel = new FileModel();
        $files = $fileModel -> where('type', 'board') -> where('bid', $bid)->findAll();

        foreach($files as $file){
            unlink('uploads/'.$file->filename);//서버에서 해당파일 삭제
        }        
        $fileModel -> where('type', 'board') -> where('bid', $bid)->delete();//테이블에서 행 삭제

        if($_SESSION['userid'] == $board->userid){
            $boardModel->delete($bid);
            return redirect()->to('/board');
        } else {
            return redirect()->to('/board')->with('alert','본인글만 삭제할 수 있습니다.');  
        }

    }
    public function save_image(){
        // 파일 정보 파악
        $fileModel = new FileModel();
        $db = db_connect();
        $file = $this->request->getFile('savefile');

        // 파일명 랜덤 생성 및 이동(store)
        if($file->getName()){
            $filename=$file->getName();
            $newName = $file ->getRandomName();
            $filepath = $file->store('board/', $newName);
        }

        // file_table에서는 bid를 받을 방법이 없음(fid : 12,13,14 / bid : 0,0,0)
        // save 함수 실행(글 등록)시 fid에 해당하는 bid 매칭됨
        $fileData=[
            'bid' => '',
            'userid' => $_SESSION['userid'],
            'filename' => $filepath,
            'type' => 'board'
        ];

        $fileModel = insert($fileData);
        $insertid = $db->insertID();        // id를 생성하는 것이 아닌 이미 만들어진 id를 조회하는 것

        $return_data = array(
            'result' => 'success',
            'fid' => $insertid,
            'savename' => $filepath
        );

        return json_encode($return_data);
        // 기존 : 파일 자체에 실행(레거시)
        // 변경 : 주소로 넘긴 값을 컨트롤러 함수로 실행 후 return
    }
}