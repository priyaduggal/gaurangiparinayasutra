<div class="card-header bg-dark text-white">
    <h5 class="mb-0 h6">{{translate('Garlic')}}</h5>
  
</div>
<div class="card-body">
    <form  action="{{url('/')}}/admin/members/updategarlic/{{$member->id }}" method="POST">
        @csrf
        <div class="form-group row">
            <div class="col-md-12">
                <!--<label for="affection">Yes</label>-->
                <input type="radio" class="form-control" name="garlic" value="0" class="form-control" 
                @if($member->garlic=='0') checked @endif>No
                
                 <!--<label for="humor">{{translate('Humor')}}</label>-->
                <input type="radio"class="form-control"  name="garlic" value="1" @if($member->garlic=='1') checked @endif>Yes
             
            </div>
         
        </div>
        <div class="form-group row">
      
        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-sm">{{translate('Update')}}</button>
        </div>
    </form>
</div>
