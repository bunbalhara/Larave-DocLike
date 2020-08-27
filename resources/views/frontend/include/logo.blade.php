<a title="Logo" href="{{route('home')}}" class="site__brand__logo d-flex">
    <div style="display: flex; flex-direction: row; justify-content: center; align-items: center; width: max-content">
        <img src="{{asset('assets/images/logo.png')}}" alt="logo" style="width: 36px; height: 36px;">
        <div style="font-size: 24px; font-family: Lato-Black-Italic; font-weight: bold; font-style: italic; color: #169bb9; margin-bottom: 3px; letter-spacing: -1px">{{__("Doctors")}}</div>
        <div style="font-size: 24px; font-family: Lato-Regular; font-weight: normal; color: #555555; margin-bottom: 3px; letter-spacing: -1px">{{__("in")}}</div>
        <div style="font-size: 24px; font-family: Lato-Black; font-weight: bold; color: #c44034; margin-bottom: 3px; text-transform: capitalize">{{__(session()->get('country','France'))}}</div>
    </div>
</a>
