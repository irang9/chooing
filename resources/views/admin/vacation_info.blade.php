@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>인트라넷 관리</h1>
        @include('components.lnb_admin')
    </div>
</div>

<div class="bd-content">
    <h2>연차 정보</h2>

    
    연차 정보 셋팅 페이지




<h2>휴가 정보 세팅</h2>
<ul>
    <li>연차 계산</li>
    <li>반차/반반차 세팅</li>
    <li>휴가일수 임의 조정</li>
</ul>



<h3>참고 내용</h3>
KIERI 연차 안내													
														
<ol>
    <li>2019년 4월 13일을 기준으로 근로기준법의 준수하여 연차일수를 계산한다. (2019.4.13 일 이후 입사자부터 적용)
        <ul>
            <li>신규 입사자 : 1개월 만근시 1일 휴가, 1년 만근가정시 총 11일 휴가일 발생.
                (직원 편의를 위해 11개를 미리 지급하지만, 실제로는 1개월에 1개 발생인 점 참고)
            </li>
        </ul>
    </li>
    <li>연차갯수는 1년 이상 근무시 15개로 산정한다 (2년 근속시 1개씩 추가)
        <ul>
            <li>*지급되는 연차는 그해년도 소진을 원칙으로 하며, 미소진시 이월 되지 아니하고 소멸된다*</li>
        </ul>
    </li>
    <li>1년 8할기준을 채우기전 중도퇴사경우 그해 근속 개월 기준으로 연차를 계산한다.
        <ul>
            <li>(퇴사 2019.4.15 → 1~3월 만근시 가정으로 휴가일 3일)</li>
        </ul>
    </li>
    <li>당일 사용/이미 사용한 건이라도 텔레그램 일정공유 방에 반드시 기록을 남긴다.
        <ul>
            <li>반차/반반차의 경우 공유시 업무시간을 함께 표기해준다.</li>
        </ul>
    </li>
</ol>
                        

[ 관리자용 - 연차 자동계산 자료 ]

1년 이상 연차
<table class="table table-bordered">
    <thead>
        <tr>
            <th>근속 연차</th>
            <th>연차 일수</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1년</td>
            <td>15</td>
        </tr>
        <tr>
            <td>2년</td>
            <td>15</td>
        </tr>
        <tr>
            <td>3년</td>
            <td>16</td>
        </tr>
        <tr>
            <td>4년</td>
            <td>16</td>
        </tr>
        <tr>
            <td>5년</td>
            <td>17</td>
        </tr>
        <tr>
            <td>6년</td>
            <td>17</td>
        </tr>
        <tr>
            <td>7년</td>
            <td>18</td>
        </tr>
        <tr>
            <td>8년</td>
            <td>18</td>
        </tr>
        <tr>
            <td>9년</td>
            <td>19</td>
        </tr>
        <tr>
            <td>10년</td>
            <td>19</td>
        </tr>
        <tr>
            <td>11년</td>
            <td>20</td>
        </tr>
        <tr>
            <td>12년</td>
            <td>20</td>
        </tr>
        <tr>
            <td>13년</td>
            <td>21</td>
        </tr>
        <tr>
            <td>14년</td>
            <td>21</td>
        </tr>
        <tr>
            <td>15년</td>
            <td>22</td>
        </tr>
        <tr>
            <td>16년</td>
            <td>22</td>
        </tr>
        <tr>
            <td>17년</td>
            <td>23</td>
        </tr>
        <tr>
            <td>18년</td>
            <td>23</td>
        </tr>
        <tr>
            <td>19년</td>
            <td>24</td>
        </tr>
        <tr>
            <td>20년</td>
            <td>24</td>
        </tr>
        <tr>
            <td>21년</td>
            <td>25</td>
        </tr>
        <tr>
            <td>22년</td>
            <td>25</td>
        </tr>
        <tr>
            <td>23년</td>
            <td>25</td>
        </tr>
        <tr>
            <td>24년</td>
            <td>25</td>
        </tr>
        <tr>
            <td>25년</td>
            <td>25</td>
        </tr>
        <tr>
            <td>26년</td>
            <td>25</td>
        </tr>
        <tr>
            <td>27년</td>
            <td>25</td>
        </tr>
        <tr>
            <td>28년</td>
            <td>25</td>
        </tr>
        <tr>
            <td>29년</td>
            <td>25</td>
        </tr>
        <tr>
            <td>30년</td>
            <td>25</td>
        </tr>
    </tbody>
</table>

1년 미만 연차

<table class="table table-bordered">
    <thead>
        <tr>
            <th>근속 개월</th>
            <th>연차 일수</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>0개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>1개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>2개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>3개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>4개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>5개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>6개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>7개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>8개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>9개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>10개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>11개월</td>
            <td>11</td>
        </tr>
        <tr>
            <td>12개월</td>
            <td>11</td>
        </tr>
    </tbody>
</table>

< 참고 >													
    · 연차(종일) :	8시간											
    · 반차 :	4시간	공지 : 반차 휴가 유형 확대 시행										
    · 반반차 :	2시간	공지 : 반반차 제도 도입										
                                                                                                            
                       
</div>

@endsection
