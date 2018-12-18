<form id="mnuForm" class="form-horizontal col-md-10" action="{{ route('admin.save',[],false) }}">
    @csrf
    <input type="hidden" class="form-control" id="id" name="id" >

    {{--
    <div class="form-group">
        <label for="family" class="col-sm-4 control-label">{{ __('Family') }}:</label>
        <div class="col-sm-8">
            <input class="form-control" id="family" name="family" >
        </div>
    </div>
    --}}

    <div class="form-group">
        <label for="title" class="col-sm-4 control-label">{{ __('Title') }}:</label>
        <div class="col-sm-8">
            <input class="form-control" id="title" name="title" >
        </div>
    </div>

    <div class="form-group">
        <label for="description" class="col-sm-4 control-label">{{ __('Description') }}:</label>
        <div class="col-sm-8">
            <input class="form-control" id="description" name="description" >
        </div>
    </div>

    <div class="form-group">
        <label for="linkref" class="col-sm-4 control-label">{{ __('Link Refer') }}:</label>
        <div class="col-sm-8">
            <input class="form-control" id="linkref" name="linkref">
        </div>
    </div>

    <div class="form-group">
        <label for="href" class="col-sm-4 control-label">{{ __('Href') }}:</label>
        <div class="col-sm-8">
            <input class="form-control" id="href" name="href">
        </div>
    </div>

    <div class="form-group">
        <label for="grant_name" class="col-sm-4 control-label">{{ __('Grant Name') }}:</label>
        <div class="col-sm-8">
            <input class="form-control" id="grant_name" name="grant_name">
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="active" name="active"> Active
                </label>
            </div>
        </div>
    </div>

</form>