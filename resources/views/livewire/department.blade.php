<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Department/Center</label>
                {{ Form::select('department_id',$this->departments,null,
                ['class'=>'form-control',
                'placeholder'=>'Select Department','wire:model'=>'selectedDepartment']) }}
                @error('department_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Section</label>
                <select name="section_id" class="form-control" required>
                    <option value="" selected>Select Section</option>
                    @foreach($this->sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
                @error('section_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>