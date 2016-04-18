<div class="panel panel-default panel-black">
    <div class="panel-heading panel-black-heading" id="panel-header-tags"><h3>Tags</h3></div>
    <div class="panel-body" id="panel-body-tags">
        <table class="table" id="accordion">

            <tr>
                <th>Title</th>
                <th>Color</th>
            </tr>

            @foreach($tags as $tag)
                <tr>
                    <td class="tag-title"> {{ $tag->title }} </td>
                    @if ($tag->color == 'blue')
                        <td class="blue-task"> {{ $tag->color }} </td>
                    @elseif($tag->color == 'red')
                        <td class="red-task"> {{ $tag->color }} </td>
                    @elseif($tag->color == 'green')
                        <td class="green-task"> {{ $tag->color }} </td>
                    @elseif($tag->color == 'yellow')
                        <td class="yellow-task"> {{ $tag->color }} </td>
                    @endif
                    <td class="text-right"><a href="{{ url('/delete_tag/'.$tag->id) }}"><span style="color:#68C3A3; " class="flaticon-close33"></span></a></td>
                </tr>
            @endforeach

        </table>

        <hr><hr><th><h4>New Tag</h4></th><hr>

        {!! Form::open(array('route' => 'storeTag', 'class' => 'form')) !!}

        <div class="form-group">
            {!! Form::label('Tag title:') !!}
            {!! Form::text('title', null,
            array('required',
            'class'=>'form-control input-black',
            'placeholder'=>'Title')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Tag color:') !!}
            {!! Form::select('color', array('Blue'=>'blue', 'Red'=>'red', 'Green'=>'green', 'Yellow'=>'yellow'), null, array('class'=>'panel-black')) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create',
            array('class'=>'btn btn-black')) !!}
        </div>

        {!! Form::close() !!}

    </div>
</div>