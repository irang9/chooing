@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>인트라넷 관리</h1>
        @include('components.lnb_admin')
    </div>
</div>

<div class="bd-content">
    <h2>회사 정보</h2>

    <!-- 브라우저 기본 alert로 성공 메시지 표시 -->
    @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif

    <form id="companyInfoForm" action="{{ route('admin.company_info.store') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td><label class="form-label">회사명</label></td>
                        <td><input type="text" class="form-control" name="company_name" value="{{ old('company_name', $companyInfo->company_name ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">사업자등록번호</label></td>
                        <td><input type="text" class="form-control" name="company_biz_reg_number" value="{{ old('company_biz_reg_number', $companyInfo->company_biz_reg_number ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">대표</label></td>
                        <td><input type="text" class="form-control" name="company_ceo_name" value="{{ old('company_ceo_name', $companyInfo->company_ceo_name ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">주소</label></td>
                        <td><input type="text" class="form-control" name="company_address" value="{{ old('company_address', $companyInfo->company_address ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">대표 전화번호</label></td>
                        <td><input type="text" class="form-control" name="company_phone" value="{{ old('company_phone', $companyInfo->company_phone ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">대표 이메일</label></td>
                        <td><input type="email" class="form-control" name="company_email" value="{{ old('company_email', $companyInfo->company_email ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">내부 민원 이메일</label></td>
                        <td><input type="email" class="form-control" name="complaint_email" value="{{ old('complaint_email', $companyInfo->complaint_email ?? '') }}"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3>출판 정보</h3>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td><label class="form-label">출판 브랜드명</label></td>
                        <td><input type="text" class="form-control" name="publishing_brand" value="{{ old('publishing_brand', $companyInfo->publishing_brand ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">출판 전화</label></td>
                        <td><input type="text" class="form-control" name="publishing_phone" value="{{ old('publishing_phone', $companyInfo->publishing_phone ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">출판 이메일</label></td>
                        <td><input type="email" class="form-control" name="publishing_email" value="{{ old('publishing_email', $companyInfo->publishing_email ?? '') }}"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3>건물 정보</h3>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td><label class="form-label">건물명</label></td>
                        <td><input type="text" class="form-control" name="office_building" value="{{ old('office_building', $companyInfo->office_building ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">관리실</label></td>
                        <td><input type="text" class="form-control" name="office_management" value="{{ old('office_management', $companyInfo->office_management ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">방재실</label></td>
                        <td><input type="text" class="form-control" name="office_fire_safety" value="{{ old('office_fire_safety', $companyInfo->office_fire_safety ?? '') }}"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">통신실</label></td>
                        <td><input type="text" class="form-control" name="office_communication" value="{{ old('office_communication', $companyInfo->office_communication ?? '') }}"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="buttons d-flex align-items-center justify-content-between gap-3">
            <button type="button" class="btn btn-secondary">취소</button>
            <button type="submit" class="btn btn-primary px-5 me-auto">저장</button>
        </div>
    </form>

</div>

@endsection
