@if(session('successMsg'))
    <div class="notification is-success rounded-none absolute top-0 left-0 w-full z-50 text-center">
        <p>{{session()->get('successMsg')}}</p>
        <button class="delete" onclick="this.parentElement.remove()"></button>
    </div>
@endif
@if(session('errorMsg'))
    <div class="notification is-danger rounded-none absolute top-0 left-0 w-full z-50 text-center">
        <p>{{session()->get('errorMsg')}}</p>
        <button class="delete" onclick="this.parentElement.remove()"></button>
    </div>
@endif
