<!-- resources/views/components/breadcrumb.blade.php -->

<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach($items as $item)
                    @if(isset($item['url']))
                        <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $item['label'] }}</li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</div>
