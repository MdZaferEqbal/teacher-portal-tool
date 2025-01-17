<label for="{{$id}}" class="form-label" id="ttp-label-{{$name}}">
    <strong>{{$label}}</strong>
    @if ($required)
        <span class="text-danger">*</span>
        <span class="text-danger d-none" id="label-span-{{$id}}">{{$label}} is required.</span>
    @endif
    @isset($labelInfo)
        <span class="text-info form-text">{{$labelInfo}}</span>
    @endisset
</label>
<div class="input-group mb-3 custom-form-input">
    <span class="input-group-text" id="input-span-{{$id}}">{!!$icon!!}</span>
    <input id="{{$id}}" class="form-control" placeholder="{{$placeholder}}" aria-describedby="input-span-{{$id}}" name="{{$name}}" value="{{$value}}" type="{{$type}}" {{$type == "number" ? ( $min != 0  ? "min=" . $min . " max=" . $max : "max=" . $max ) : "" }} {{$required ? "required" : ""}} {{$disabled ? "disabled" : ""}}/>
    @isset($info)
        <div id="ttp-info" class="form-text">{{$info}}</div>
    @endisset
    @error($name)
        <span class="input-group-text bg-danger"><i class="fa-solid fa-exclamation"></i></span>
    @enderror
</div>
