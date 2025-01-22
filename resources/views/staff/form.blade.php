@csrf
<div class="mb-3">
    <label for="name" class="form-label">이름</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $staff->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="phone" class="form-label">휴대폰</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $staff->phone ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="company_phone" class="form-label">회사전화</label>
    <input type="text" class="form-control" id="company_phone" name="company_phone" value="{{ old('company_phone', $staff->company_phone ?? '') }}">
</div>
<div class="mb-3">
    <label for="extension" class="form-label">내선번호</label>
    <input type="text" class="form-control" id="extension" name="extension" value="{{ old('extension', $staff->extension ?? '') }}">
</div>
<div class="mb-3">
    <label for="email" class="form-label">이메일</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $staff->email ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="hire_date" class="form-label">입사일</label>
    <input type="date" class="form-control" id="hire_date" name="hire_date" value="{{ old('hire_date', $staff->hire_date ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="status" class="form-label">상태</label>
    <select class="form-control" id="status" name="status" required>
        <option value="" disabled {{ !isset($staff) ? 'selected' : '' }}>선택</option>
        <option value="재직" {{ (isset($staff) && $staff->status == '재직') ? 'selected' : '' }}>재직</option>
        <option value="외주" {{ (isset($staff) && $staff->status == '외주') ? 'selected' : '' }}>외주</option>
        <option value="퇴사" {{ (isset($staff) && $staff->status == '퇴사') ? 'selected' : '' }}>퇴사</option>
        <option value="기타" {{ (isset($staff) && $staff->status == '기타') ? 'selected' : '' }}>기타</option>
    </select>
</div>
<button type="submit" class="btn btn-primary">저장</button>
<a href="{{ route('staff.index') }}" class="btn btn-secondary">목록으로</a>
