<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Type of Activity</label>
                {{ Form::select('visit_activity_type_id',$visit_activity_types,null,
                ['class'=>'form-control',
                'placeholder'=>'Select Activity','wire:model'=>'selectedActivityType']) }}
            </div>
        </div>
        @if($this->show_link)
        <div class="col-md-6">
            <div class="form-group">
                <label for="cv">Guest Lecturer CV</label>
                <input type="text" name="cv_link" class="form-control" required>
                @error('cv_link')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endif
    </div>
</div>