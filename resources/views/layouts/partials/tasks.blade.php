<div class="panel panel-default panel-black">
    <div class="panel-heading panel-black-heading" id="panel-header-tasks">
        <b><i>Tasks</i></b>
        <ul class="nav navbar navbar-right col-lg-3">
            {!! Form::open(array('route' => 'filterTasks', 'class' => 'form', 'id' => 'stateFilter')) !!}
            <select id="state" name="state" class="panel-black">
                <option>Filter tasks by state</option>
                <option value="all">All</option>
                <option value="Pending">Pending</option>
                <option value="In process">In process</option>
                <option value="Completed">Completed</option>
            </select>
            {!! Form::close() !!}
        </ul>
    </div>
    <div class="panel-body" id="panel-body-tasks">
        <table class="table" id="accordion">
            <tr>
                <th>Title</th>
                <th>Deadline</th>
                <th>State</th>
            </tr>

            @foreach($tasks as $task)
                @if ($task->deadline < \Carbon\Carbon::now())
                    <tr>
                        <td class="past-task"> <a href=""> {{ $task->title }} </a></td>
                        <td class="past-task"> {{ $task->deadline }} </td>
                        <td class="past-task"> {{ $task->state }} </td>
                        <td class="text-right"><a href="{{ url('/delete_task/'.$task->id) }}"><span style="color:#68C3A3; " class="flaticon-close33"></span></a></td>
                    </tr>
                @else
                    <tr>
                        <td class="current-task"> <a href=""> {{ $task->title }} </a></td>
                        <td class="current-task"> {{ $task->deadline }} </td>
                        <td class="current-task"> {{ $task->state }} </td>
                        <td class="text-right"><a href="{{ url('/delete_task/'.$task->id) }}"><span style="color:#68C3A3; " class="flaticon-close33"></span></a></td>
                    </tr>
                @endif
             @endforeach

        </table>

        <hr><hr><th><b><i>New Task</i></b></th><hr>

        {!! Form::open(array('route' => 'storeTask', 'class' => 'form')) !!}

        <div class="form-group">
            {!! Form::label('Task title:') !!}
            {!! Form::text('title', null,
            array('required',
            'class'=>'form-control input-black',
            'placeholder'=>'Title')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Task description:') !!}
            {!! Form::textarea('description', null,
            array('required',
            'class'=>'form-control input-black',
            'placeholder'=>'Enter task description here...')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Task Deadline:') !!}
            <tr>
                <div class="row">
                    <div class='col-md-4'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker'>
                                <input placeholder="Deadline" type="datetime" required="required" name="deadline" class="form-control input-black"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>

            </tr>
        </div>

        <div class="form-group">
            {!! Form::submit('Create',
            array('class'=>'btn btn-black')) !!}
        </div>

        {!! Form::close() !!}
    </div>
</div>