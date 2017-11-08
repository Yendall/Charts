@if(!$model->customId)
    @include('charts::_partials.container.canvas2')
@endif

<script type="text/javascript">
    var ctx = document.getElementById("{{ $model->id }}");
    var options = {!! $model->extraOptions !!};

    @if($model->height)
        ctx.style.height = "100px";
    ctx.height = {!! $model->height !!};
        @endif

    var data = {
            labels: [
                @foreach($model->labels as $label)
                    "{!! $label !!}",
                @endforeach
            ],
            datasets: [
                {
                    fill: true,
                    label: "{!! $model->element_label !!}",
                    lineTension: 0.3,
                    @if($model->colors)
                    borderColor: "{{ $model->colors[0] }}",
                    backgroundColor: "{{ $model->colors[0] }}",
                    @endif
                    data: [
                        @foreach($model->values as $dta)
                        {{ $dta }},
                        @endforeach
                    ],
                }
            ]
        };

    var {{ $model->id }} = new Chart(ctx, {
        type: 'line',
        data: data,
        @if($model->extraOptions)
        options: options
        @else
        options:
            {
                responsive: {{ $model->responsive || !$model->width ? 'true' : 'false' }},
                maintainAspectRatio: false,
                @if($model->title)
                title: {
                    display: true,
                    text: "{!! $model->title !!}",
                    fontSize: 20,
                }
                @endif
            }
        @endif
    });



</script>
