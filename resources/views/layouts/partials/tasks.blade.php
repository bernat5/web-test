<div class="panel panel-default panel-black">
    <div class="panel-heading panel-black-heading" id="panel-header-tasks">
        <h3>Tasks</h3>
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
                <th>Tags</th>
                <th>Deadline</th>
                <th>State</th>
            </tr>

            @foreach($tasks as $task)
                @if($task->deadline == '0000-00-00 00:00:00')
                    <tr>
                        <td class="current-task"> <b><a style="color: #d58512" href="{{ url('/task_detail/'.$task->id) }}"> {{ $task->title }} </a></b></td>
                        <td class="current-task">
                            @foreach($rel_tasks_tags as $rel)
                                @if($rel->task_id == $task->id)
                                    @if($rel->getTag->color == 'blue')
                                        <h5 style="color: blue">{{ $rel->getTag->title }}</h5>
                                    @elseif($rel->getTag->color == 'green')
                                        <h5 style="color: green">{{ $rel->getTag->title }}</h5>
                                    @elseif($rel->getTag->color == 'red')
                                        <h5 style="color: red">{{ $rel->getTag->title }}</h5>
                                    @elseif($rel->getTag->color == 'yellow')
                                        <h5 style="color: yellow">{{ $rel->getTag->title }}</h5>
                                    @endif
                                @endif
                            @endforeach
                        </td>
                        <td class="current-task">No deadline</td>
                        <td class="current-task"> {{ $task->state }} </td>
                        <td class="text-right"><a href="{{ url('/delete_task/'.$task->id) }}"><span style="color:#68C3A3; " class="flaticon-close33"></span></a></td>
                    </tr>
                @else
                    @if ($task->deadline < \Carbon\Carbon::now())
                        <tr>
                            <td class="past-task"> <b><a style="color: #d58512" href="{{ url('/task_detail/'.$task->id) }}"> {{ $task->title }} </a></b></td>
                            <td class="current-task">
                                @foreach($rel_tasks_tags as $rel)
                                    @if($rel->task_id == $task->id)
                                        @if($rel->getTag->color == 'blue')
                                            <h5 style="color: blue">{{ $rel->getTag->title }}</h5>
                                        @elseif($rel->getTag->color == 'green')
                                            <h5 style="color: green">{{ $rel->getTag->title }}</h5>
                                        @elseif($rel->getTag->color == 'red')
                                            <h5 style="color: red">{{ $rel->getTag->title }}</h5>
                                        @elseif($rel->getTag->color == 'yellow')
                                            <h5 style="color: yellow">{{ $rel->getTag->title }}</h5>
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td class="past-task"> {{ $task->deadline }} </td>
                            <td class="past-task"> {{ $task->state }} </td>
                            <td class="text-right"><a href="{{ url('/delete_task/'.$task->id) }}"><span style="color:#68C3A3; " class="flaticon-close33"></span></a></td>
                        </tr>
                    @else
                        <tr>
                            <td class="current-task"> <b><a style="color: #d58512" href="{{ url('/task_detail/'.$task->id) }}"> {{ $task->title }} </a></b></td>
                            <td class="current-task">
                                @foreach($rel_tasks_tags as $rel)
                                    @if($rel->task_id == $task->id)
                                        @if($rel->getTag->color == 'blue')
                                            <h5 style="color: blue">{{ $rel->getTag->title }}</h5>
                                        @elseif($rel->getTag->color == 'green')
                                            <h5 style="color: green">{{ $rel->getTag->title }}</h5>
                                        @elseif($rel->getTag->color == 'red')
                                            <h5 style="color: red">{{ $rel->getTag->title }}</h5>
                                        @elseif($rel->getTag->color == 'yellow')
                                            <h5 style="color: yellow">{{ $rel->getTag->title }}</h5>
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td class="current-task"> {{ $task->deadline }} </td>
                            <td class="current-task"> {{ $task->state }} </td>
                            <td class="text-right"><a href="{{ url('/delete_task/'.$task->id) }}"><span style="color:#68C3A3; " class="flaticon-close33"></span></a></td>
                        </tr>
                    @endif
                @endif
             @endforeach

        </table>

        <hr><hr><th><h4>New Task</h4></th><hr>

        {!! Form::open(array('route' => 'storeTask', 'class' => 'form')) !!}

        <div class="form-group">
            {!! Form::label('Task Title:') !!}
            {!! Form::text('title', null,
            array('required',
            'class'=>'form-control input-black',
            'placeholder'=>'Title')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Task Description:') !!}
            {!! Form::textarea('description', null,
            array('required',
            'class'=>'form-control input-black',
            'placeholder'=>'Enter task description here...')) !!}
        </div>

        <div class="form-group">
            <label>Task Tags:</label>
            <select multiple class="form-control select_black" required="required" name="tags[]">
                @foreach($tags as $tag)
                    @if($tag->color == 'blue')
                        <option value="{{ $tag->id }}" style="color: blue">{{ $tag->title }}</option>
                    @elseif($tag->color == 'green')
                        <option value="{{ $tag->id }}" style="color: green">{{ $tag->title }}</option>
                    @elseif($tag->color == 'red')
                        <option value="{{ $tag->id }}" style="color: red">{{ $tag->title }}</option>
                    @elseif($tag->color == 'yellow')
                        <option value="{{ $tag->id }}" style="color: yellow">{{ $tag->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {!! Form::label('Task Deadline:') !!}
            <tr>
                <div class="row">
                    <div class='col-md-4'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker'>
                                <input placeholder="Deadline" type="datetime" name="deadline" class="form-control input-black"/>
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