<div class="row">
    <div class="mb-4 col-md-6">
        <div class="custom-form-group">
        {{ html()->label('Name', 'name') }}
        <x-required />
        {{ html()->text('name')->class('form-control ' . ($errors->has('name') ? 'is-invalid' : ''))->placeholder(__('Enter name')) }}
        <x-validation-error :error="$errors->first('name')" />
    </div>
</div>

<div class="mb-4 col-md-6">
    <div class="custom-form-group">
        {{ html()->label('Designation', 'designation') }}
        {{ html()->text('designation')->class('form-control ' . ($errors->has('designation') ? 'is-invalid' : ''))->placeholder(__('Enter designation')) }}
        <x-validation-error :error="$errors->first('designation')" />
    </div>
</div>

<div class="mb-4 col-md-6">
    <div class="custom-form-group">
        {{ html()->label('Image', 'image') }}
        {{ html()->file('image')->class('form-control ' . ($errors->has('image') ? 'is-invalid' : '')) }}
        <x-validation-error :error="$errors->first('image')" />
    </div>
</div>


<div class="mb-4 col-md-6">
    <div class="custom-form-group">
        {{ html()->label('Status', 'status') }}
        {{ html()->select('status', \App\Models\Testimonial::STATUS_LIST)->class('form-control ' . ($errors->has('status') ? 'is-invalid' : '')) }}
        <x-validation-error :error="$errors->first('status')" />
    </div>
</div>


<div class="mb-4 col-md-12">
    <div class="custom-form-group">
        {{ html()->label('Description', 'description') }}
        {{ html()->textarea('description')->class('form-control ' . ($errors->has('description') ? 'is-invalid' : ''))->placeholder(__('Enter description')) }}
        <x-validation-error :error="$errors->first('description')" />
    </div>
</div>


</div>
