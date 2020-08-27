<a title="Logo" href="{{route('home')}}" class="site__brand__logo d-flex">
    <div style="display: flex; flex-direction: row; justify-content: center; align-items: center; width: max-content">
        <img src="{{asset('assets/images/logo.png')}}" alt="logo" style="width: 36px; height: 36px;">
        <div style="font-size: 24px; font-family: 'Lato'; font-weight: bold; font-style: italic; color: #169bb9; text-shadow: 0 1px, 1px 0, 1px 1px; margin-bottom: 3px">{{__("Doctors")}}</div>
        <div style="font-size: 22px; font-family: 'Lato'; font-weight: normal; color: #555555;margin-right: -2px; margin-left: 1px; margin-bottom: 3px">{{__("in")}}</div>
        <div style="font-size: 24px; font-family: 'Lato'; font-weight: bold; color: #c44034;text-shadow: 0 1px, 1px 0, 1px 1px; margin-bottom: 3px">{{__(session()->get('country','France'))}}</div>
    </div>
</a>
