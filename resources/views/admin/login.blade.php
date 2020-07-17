<form action="{{url('loginDo')}}" method="post">
    @csrf
    用户名<input name="name" type="text"><font color="red">{{$errors->first('name')}}{{session('msg')}}</font><br>
    密码<input type="text" name="password"><font color="red">{{$errors->first('password')}}{{session('pwd')}}</font><br>
    <input type="submit" value="点击登录">
</form>
