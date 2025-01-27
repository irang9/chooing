@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>업무 자료</h1>
        @include('components.lnb_office')
    </div>
</div>

<div class="bd-content">
    <h2>공용 계정</h2>

    <table class="table" id="accountTable">
        <thead>
            <tr>
                <th>No</th>
                <th>사용처</th>
                <th>아이디</th>
                <th>비밀번호</th>
                <th>2차인증</th>
                <th>Updated</th>
                <th>메모</th>
                <th>주사용자</th>
                <th>액션</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 5; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td><input type="text" name="usage[]"></td>
                <td><input type="text" name="username[]"></td>
                <td><input type="text" name="password[]"></td>
                <td><input type="text" name="two_factor_auth[]"></td>
                <td></td>
                <td><input type="text" name="memo[]"></td>
                <td><input type="text" name="main_user[]"></td>
                <td>
                    <button type="button" class="btn btn-success btn-sm">저장</button>
                    <button type="button" class="btn btn-danger btn-sm">삭제</button>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>

    <button type="button" class="btn btn-primary" onclick="addRow()">추가</button>

</div>

<script>
function addRow() {
    const table = document.getElementById('accountTable').getElementsByTagName('tbody')[0];
    const rowCount = table.rows.length + 1;
    const newRow = table.insertRow();

    newRow.innerHTML = `
        <tr>
            <td>${rowCount}</td>
            <td><input type="text" name="usage[]"></td>
            <td><input type="text" name="username[]"></td>
            <td><input type="text" name="password[]"></td>
            <td><input type="text" name="two_factor_auth[]"></td>
            <td></td>
            <td><input type="text" name="memo[]"></td>
            <td><input type="text" name="main_user[]"></td>
            <td>
                <button type="button" class="btn btn-success btn-sm">저장</button>
                <button type="button" class="btn btn-danger btn-sm">삭제</button>
            </td>
        </tr>
    `;
}
</script>

@endsection
