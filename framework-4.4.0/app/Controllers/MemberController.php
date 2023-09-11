<?php

namespace App\Controllers;
use App\Models\BoardModel;      // 사용할 모델을 로드
use CodeIgniter\I18n\Time;      // 날짜 라이브러리
class MemberController extends BaseController
{
    // login 함수가 할 일
    public function login(){
        return render('login');
    }

    // logout 함수가 할 일
    public function loginok()
    {
        $userid = $this->request->getVar('userid'); //request에서 userid 파라미터값 할당
        $passwd = hash('sha512', $this->request->getVar('passwd'));
        //request에서 passwd 파라미터값을 sha512알고리즘으로 암호화 하고 passwd에 할당
    
        $db = db_connect();
        $query = "SELECT * FROM members WHERE userid = ? AND passwd = ?"; //입력한 id, pw을 조회하는 쿼리
        $rs = $db->query($query, [$userid, $passwd]); //쿼리 실행 결과 담기
        $result = $rs->getResult(); //쿼리 결과를 배열로 출력

        if (count($result) > 0) { //쿼리 실행결과가 있다면
            $user = $rs->getRow();//단일 행을 객체 형태로 가져옴
            $ses_data = [
                'userid' => $user->userid,
                'username' => $user->username,
                'email' => $user->email
            ];
            $this->session->set($ses_data);//해당 사용자의 데이타를 배열에 담아서 세션에 저장한다.
            return redirect()->to('/board');
        } else {
            return redirect()->to('/login')->with('alert', '다시 시도해보세요.');
        }
    }
}