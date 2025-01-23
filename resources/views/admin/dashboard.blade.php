@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex  align-items-center justify-content-between">
        <h1>관리</h1>
    </div>
</div>


<div class="bd-content">


    <h1>인트라넷</h1>


    

    <h2>구현할 기능 나열</h2>
    <ul>
        <li>메인(로그인)
            <ul>
                <li>최근 공지사항 2건</li>
                <li>내 정보, 생일시 축하표기</li>
                <li>달력
                    <ul>
                        <li>휴가 표시</li>
                        <li>입사일/입사기준일 표시</li>
                    </ul>
                </li>
                <li>내 휴가 일수</li>
                <li>휴가 사용 신청</li>
                <li>휴가 관리</li>
                <li>업무 관련 링크 (이메일, 아사나, 텔레그램)</li>
                <li>업무 계정</li>
                <li>회사 정보 (사업자 등록증 등)</li>
                <li>운영중인 서비스 바로가기</li>
            </ul>
        </li>
        <li>검색 : 사원, 연락처, 공지 내용 등 모든 것</li>
        <li>로그인 후 메인
            <ul>
                
            </ul>
        </li>
        <li>사원 정보
            <ul>
                <li>내 정보
                    <ul>
                        <li>이름</li>
                        <li>생년월일</li>
                        <li>입사일</li>
                        <li>휴대 전화번호</li>
                        <li>회사 전화번호 (내선번호)</li>
                        <li>회사 이메일</li>
                        <li>업무시간</li>
                    </ul>
                </li>
                <li>다른 사원 정보 (연락처 등)</li>
                <li>퇴사자 정보 (관리자만 보임)</li>
                <li>등급 기능 : 3개 (관리자, 매니저, 사원)</li>
            </ul>
        </li>
        <li>휴가 관리
            <ul>
                <li>휴가 신청
                    <ul>
                        <li>휴가 종류  : 종일, 반차, 반반차, 경조사 (휴가일 차감 x)</li>
                        <li>휴가 일정 : 달력 표기, 개별 업무시간 기준으로 업무시간 반영하여 표기</li>
                        <li>휴가 사유</li>
                    </ul>
                </li>
                <li>휴가 신청중 (진행중?)
                    <ul>
                        <li>신청한 내역이 있는 경우에만</li>
                        <li>휴가일 도래 전까지 수정 가능</li>
                    </ul>
                </li>
                <li>휴가 사용 내역
                    <ul>
                        <li>날짜, 종류, 사유, 관리자 코멘트</li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>공지사항
            <ul>
                <li>목록 : 업데이트 날짜로 표기, 고정 기능</li>
                <li>읽기 : 읽은 사람 표기</li>
                <li>작성/수정/삭제 : 관리자만 사용, 수정시 최종 업데이트 날짜 표기</li>
                <li>삭제 : 휴지통 기능</li>
            </ul>
        </li>
        <li>업무 자료
            <ul>
                <li>회사 계정, 장비, 구독 데이터베이스</li>
                <li>제휴 업체 정보</li>
                <li>자료실</li>
                <li>업무 사례</li>
            </ul>
        </li>
        <li>게시판</li>
        <li>관리
            <ul>
                <li>사원 등록</li>
                <li>휴가 갯수 임의 등록</li>
                <li>텔레그램 전송 기능</li>
                <li>이메일 발송 기능</li>
                <li>사용자 레벨 : 마스터, 매니저, 사용자</li>
            </ul>
        </li>
    </ul>



    
</div>
@endsection
