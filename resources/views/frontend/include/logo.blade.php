<a title="Logo" href="{{route('home')}}" class="site__brand__logo d-flex">
    <div style="display: flex; flex-direction: row; justify-content: center; align-items: center; width: max-content">
        <img src="{{asset('assets/images/logo.png')}}" alt="logo" style="width: 36px; height: 36px">
        <div style="margin-left: -13px; font-size: 22px; font-family: 'Lato'; font-weight: bold; font-style: italic; letter-spacing: -1px; color: #169bb9">{{__("Doctors")}}</div>
        <div style="font-size: 22px; font-family: 'Lato'; font-weight: normal; color: #555555">{{__("in")}}</div>
        <div style="font-size: 22px; font-family: 'Lato'; font-weight: bold; letter-spacing: -1px; color: #c44034">{{__(session()->get('country','France'))}}</div>
    </div>
</a>
