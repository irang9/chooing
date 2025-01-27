@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>인트라넷 관리</h1>
        @include('components.lnb_admin')
    </div>
</div>

<div class="bd-content">
    <h2>근무 조건</h2>

    <form id="workInfoForm" action="" method="POST">
        @csrf
        <h3>재직상태 (user_status)</h3>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td><label class="form-label">1</label></td>
                        <td><input type="text" class="form-control" name="user_status_1" value="재직"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">2</label></td>
                        <td><input type="text" class="form-control" name="user_status_2" value="퇴사"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">3</label></td>
                        <td><input type="text" class="form-control" name="user_status_3" value="외주"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">4</label></td>
                        <td><input type="text" class="form-control" name="user_status_4" value="휴직"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">5</label></td>
                        <td><input type="text" class="form-control" name="user_status_5" value="기타"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">6</label></td>
                        <td><input type="text" class="form-control" name="user_status_6" value="추가 입력란1"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">7</label></td>
                        <td><input type="text" class="form-control" name="user_status_7" value="추가 입력란2"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3>점심시간 (company_lunch)</h3>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td><label class="form-label">점심시간</label></td>
                        <td>
                            <div class="d-flex">
                                <input type="time" class="form-control me-2" name="lunch_start_time" id="lunch_start_time" value="11:20" min="10:00" max="13:00">
                                <span class="me-2">~</span>
                                <input type="time" class="form-control" name="lunch_end_time" id="lunch_end_time" value="12:20" min="10:00" max="13:00">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3>근무 시간 프리셋</h3>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td><label class="form-label">시간세팅이름:휴무</label></td>
                        <td><input type="text" class="form-control" name="preset_name_1" value="휴무"></td>
                    </tr>
                    <tr>
                        <td><label class="form-label">시간세팅이름:기본근무</label></td>
                        <td>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" name="preset_name_2" value="기본근무">
                                <input type="time" class="form-control me-2" name="preset_start_time_2" value="09:00">
                                <input type="time" class="form-control" name="preset_end_time_2" value="18:00">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="form-label">시간세팅이름입력</label></td>
                        <td>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" name="preset_name_3" value="">
                                <input type="time" class="form-control me-2" name="preset_start_time_3" value="">
                                <input type="time" class="form-control" name="preset_end_time_3" value="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="form-label">시간세팅이름입력</label></td>
                        <td>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" name="preset_name_4" value="">
                                <input type="time" class="form-control me-2" name="preset_start_time_4" value="">
                                <input type="time" class="form-control" name="preset_end_time_4" value="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="form-label">시간세팅이름입력</label></td>
                        <td>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" name="preset_name_5" value="">
                                <input type="time" class="form-control me-2" name="preset_start_time_5" value="">
                                <input type="time" class="form-control" name="preset_end_time_5" value="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="form-label">시간세팅이름입력</label></td>
                        <td>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" name="preset_name_6" value="">
                                <input type="time" class="form-control me-2" name="preset_start_time_6" value="">
                                <input type="time" class="form-control" name="preset_end_time_6" value="">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="buttons d-flex align-items-center justify-content-between gap-3">
            <button type="button" class="btn btn-secondary">취소</button>
            <button type="submit" class="btn btn-primary px-5 me-auto">저장</button>
        </div>
    </form>

    <h3>근무 최종 프리셋 설정 (user_work_time)</h3>
    @for ($i = 1; $i <= 5; $i++)
    <form id="finalPresetForm_{{ $i }}" action="" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{ $i }}. 프리셋 이름</label>
            <input type="text" class="form-control" name="preset_name_{{ $i }}" value="{{ $i == 1 ? '기본근무' : '' }}">
        </div>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td>월요일</td>
                        <td>
                            <select class="form-control" name="monday_preset_{{ $i }}">
                                <option value="기본근무">기본근무</option>
                                <option value="휴무">휴무</option>
                                <option value="프리셋3">프리셋3</option>
                                <option value="프리셋4">프리셋4</option>
                                <option value="프리셋5">프리셋5</option>
                                <option value="프리셋6">프리셋6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>화요일</td>
                        <td>
                            <select class="form-control" name="tuesday_preset_{{ $i }}">
                                <option value="기본근무">기본근무</option>
                                <option value="휴무">휴무</option>
                                <option value="프리셋3">프리셋3</option>
                                <option value="프리셋4">프리셋4</option>
                                <option value="프리셋5">프리셋5</option>
                                <option value="프리셋6">프리셋6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>수요일</td>
                        <td>
                            <select class="form-control" name="wednesday_preset_{{ $i }}">
                                <option value="기본근무">기본근무</option>
                                <option value="휴무">휴무</option>
                                <option value="프리셋3">프리셋3</option>
                                <option value="프리셋4">프리셋4</option>
                                <option value="프리셋5">프리셋5</option>
                                <option value="프리셋6">프리셋6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>목요일</td>
                        <td>
                            <select class="form-control" name="thursday_preset_{{ $i }}">
                                <option value="기본근무">기본근무</option>
                                <option value="휴무">휴무</option>
                                <option value="프리셋3">프리셋3</option>
                                <option value="프리셋4">프리셋4</option>
                                <option value="프리셋5">프리셋5</option>
                                <option value="프리셋6">프리셋6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>금요일</td>
                        <td>
                            <select class="form-control" name="friday_preset_{{ $i }}">
                                <option value="기본근무">기본근무</option>
                                <option value="휴무">휴무</option>
                                <option value="프리셋3">프리셋3</option>
                                <option value="프리셋4">프리셋4</option>
                                <option value="프리셋5">프리셋5</option>
                                <option value="프리셋6">프리셋6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>토요일</td>
                        <td>
                            <select class="form-control" name="saturday_preset_{{ $i }}">
                                <option value="휴무" selected>휴무</option>
                                <option value="기본근무">기본근무</option>
                                <option value="프리셋3">프리셋3</option>
                                <option value="프리셋4">프리셋4</option>
                                <option value="프리셋5">프리셋5</option>
                                <option value="프리셋6">프리셋6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>일요일</td>
                        <td>
                            <select class="form-control" name="sunday_preset_{{ $i }}">
                                <option value="휴무" selected>휴무</option>
                                <option value="기본근무">기본근무</option>
                                <option value="프리셋3">프리셋3</option>
                                <option value="프리셋4">프리셋4</option>
                                <option value="프리셋5">프리셋5</option>
                                <option value="프리셋6">프리셋6</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    @endfor

    <div class="buttons d-flex align-items-center justify-content-between gap-3 mt-4">
        <button type="button" class="btn btn-secondary">취소</button>
        <button type="submit" class="btn btn-primary px-5 me-auto">저장</button>
    </div>
</div>

@endsection
