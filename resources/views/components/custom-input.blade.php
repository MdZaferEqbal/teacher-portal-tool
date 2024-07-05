<label for="{{$id}}" class="form-label">
    <strong>{{$label}}</strong>
    @if ($required)
        <span class="text-danger">*</span>
        <span class="text-danger d-none" id="label-span-{{$id}}">{{$label}} is required.</span>
    @endif
</label>
<div class="input-group mb-3 custom-form-input">
    <span class="input-group-text" id="input-span-{{$id}}">{!!$icon!!}</span>
    <input id="{{$id}}" class="form-control" placeholder="{{$placeholder}}" aria-label="Username" aria-describedby="input-span-{{$id}}" name="{{$name}}" value="{{$value}}" type="{{$type}}" {{$required ? "required" : ""}}/>
    @error($name)
        <span class="input-group-text bg-danger"><i class="fa-solid fa-exclamation"></i></span>
    @enderror
</div>
