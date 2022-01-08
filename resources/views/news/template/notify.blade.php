@if (session('news_notify'))
    <div class="alert alert-danger">
        {{ session('news_notify') }}
    </div>
@endif
