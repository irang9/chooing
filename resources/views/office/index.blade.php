@extends('layouts.app')

@section('content')
<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>업무 자료</h1>
        @include('components.lnb_office')
    </div>
</div>

<div class="bd-content">
    <h2>회사 생활</h2>
    
    @foreach($companyInfo as $info)

    <h4>회사 정보</h4>
    - 회사명 : {{ $info->company_name ?? '' }}<br>
    - 사업자등록번호 : {{ $info->biz_reg_number ?? '' }}<br>
    - 대표 : {{ $info->company_ceo_name ?? '' }}<br>
    - 주소 : {{ $info->company_address ?? '' }}<br>
    - 대표 전화번호 : {{ $info->company_phone ?? '' }}<br>
    - 대표 이메일 : {{ $info->company_email ?? '' }}<br>
    - 내부 민원 이메일 : {{ $info->complaint_email ?? '' }}<br>

    <h4>출판 정보</h4>
    - 출판 브랜드명 : {{ $info->publishing_brand ?? '' }}<br>
    - 출판 전화 : {{ $info->publishing_phone ?? '' }}<br>
    - 출판 이메일 : {{ $info->publishing_email ?? '' }}<br>

    <h4>건물 정보</h4>
    - 건물명 : {{ $info->office_building ?? '' }}<br>
    - 관리실 : {{ $info->office_management ?? '' }}<br>
    - 방재실 : {{ $info->office_fire_safety ?? '' }}<br>
    - 통신실 : {{ $info->office_communication ?? '' }}<br>

    @endforeach

</div>
@endsection
