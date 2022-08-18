<form method="POST" action="{{route('contactus.store')}}">
    @csrf
    @guest
    email <input type="text" name="email">
    @endguest
    @if(App::getLocale()=='en')
    @guest
    name_en <input type="text" name="name_en">
    @endguest
    message_en <textarea name="message_en"></textarea>
    @elseif(App::getLocale()=='ar')
    @guest
    name<input type="text" name="name">
    @endguest
    message <textarea name="message"></textarea>
    @endif
    <button>add</button>
</form>