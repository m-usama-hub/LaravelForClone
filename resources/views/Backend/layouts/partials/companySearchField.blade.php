
    <div class="form-group">
        <label>By Company</label>
        <select name="company_id" class="form-control" id="">
            <option value="">*</option>
            @php
                $company = App\Models\Company::get();
            @endphp
            @foreach ($company as $item)
                <option value="{{ $item->id }}" {{ Request::get('company_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

