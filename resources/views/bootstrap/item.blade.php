<div class="row" data-id="{{ $comment['id'] }}" id="mural-comment-{{ $comment['id'] }}">
    <div class="col-md-1" style="width: 5.33%;">
        <a href="{{ $comment->author->commentator_permalink }}" class="avatar">
            <img src="{{ $comment->author->commentator_avatar }}" title="" class="img-rounded">
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <a href="{{ $comment->author->commentator_permalink }}" class="author">
                <b>{{ $comment->author->commentator_name }}</b>
            </a>
            <span>&nbsp;</span>
            <span class="date">
                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}
            </span>
        </div>
        <div class="col-md-10">
            {{ $comment->body }}
            <span>&nbsp;</span>
        </div>
        
        <div class="actions">
            @if(auth()->check() && auth()->user()->canModerateComment())
                <form class="form-remove" action="{{ route('mural.destroy', $comment->id) }}" method="POST">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <a class="button-remove"><i class="icon trash"></i> @lang('mural::mural.remove')</a>
                </form>
            @endif
        </div>
    </div>

    @if(config('mural.vote'))
    <div class="extra content">
        {!! \Laravolt\Votee\VoteeFacade::render($comment, ['class' => 'basic', 'size' => 'mini']) !!}
    </div>
    @endif

    <div class="ui inverted dimmer">
        <div class="ui mini text loader">@lang('mural::mural.loading')</div>
    </div>
</div>
