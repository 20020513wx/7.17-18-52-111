<form action="{{url('regDo')}}" method="post">
    @csrf
    用户名注册<input name="name" type="text"><font color="red">{{$errors->first('name')}}</font><br>
    密码<input type="text" name="password"><font color="red">{{$errors->first('password')}}</font><br>
    确认密码<input type="text" name="pwds"><font color="red">{{$errors->first('pwds')}}{{session('msg')}}</font><br>
    <input type="submit" value="点击注册">
</form>
