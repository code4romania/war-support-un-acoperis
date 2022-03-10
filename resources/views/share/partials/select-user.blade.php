@php($users = \App\Services\UserService::getChildrenUsers())
@if(!empty($users))
    <form class="form-inline" action="{{route('shared.select.user')}}" method="POST">
        @csrf
       <p>{{__('Select an existent user')}}</p>
        <select class="form-control " name="existentUserId">
            @foreach($users as $user)
                <option value="{{$user['id']}}">{{$user['name']}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">{{__('Select')}}</button>
    </form>
@endif
