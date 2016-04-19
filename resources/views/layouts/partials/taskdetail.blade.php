<div class="panel panel-default panel-black">
    <div class="panel-heading panel-black-heading" id="panel-header-tasks">
        <h3>{{ $task->title }}</h3>
    </div>
    <div class="panel-body" id="panel-body-tasks">
        <h4>Description</h4>
        <h5 style="color:whitesmoke">{{ $task->description }}</h5>
        <br>
        <h4>Tags</h4>
        @foreach($rel_tasks_tags as $rel)
            @if($rel->getTag->color == 'blue')
                <b style="color: blue"><th>{{ $rel->getTag->title }}</th></b>
            @elseif($rel->getTag->color == 'green')
                <b style="color: green"><th>{{ $rel->getTag->title }}</th></b>
            @elseif($rel->getTag->color == 'red')
                <b style="color: red"><th>{{ $rel->getTag->title }}</th></b>
            @elseif($rel->getTag->color == 'yellow')
                <b style="color: yellow"><th>{{ $rel->getTag->title }}</th></b>
            @endif
            &nbsp;
            &nbsp;
        @endforeach
        <br><br>
        <h4>Deadline</h4>
        @if ($task->deadline == '0000-00-00 00:00:00')
            <h5 style="color:whitesmoke">No deadline</h5>
        @elseif ($task->deadline < \Carbon\Carbon::now())
            <h5 style="color:red">{{ $task->deadline }}</h5>
        @else
            <h5 style="color:whitesmoke">{{ $task->deadline }}</h5>
        @endif
        <br>
        <h4>State</h4>
        {!! Form::open(array('route' => array('updateTaskState', $task->id), 'class' => 'form', 'id' => 'updateState')) !!}
        <select id="stateUp" name="state" class="panel-black">
            @if($task->state == 'Pending')
                <option value="Pending" selected="selected">Pending</option>
                <option value="In process">In process</option>
                <option value="Completed">Completed</option>
            @elseif($task->state == 'In process')
                <option value="Pending">Pending</option>
                <option value="In process" selected="selected">In process</option>
                <option value="Completed">Completed</option>
            @elseif($task->state == 'Completed')
                <option value="Pending" selected="selected">Pending</option>
                <option value="In process">In process</option>
                <option value="Completed" selected="selected">Completed</option>
            @endif
        </select>
        {!! Form::close() !!}
    </div>
</div>