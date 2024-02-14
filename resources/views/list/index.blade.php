<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
          background-color: #d778e2; /* Set background color to #d778e2 */
          color: #fff; /* Set text color to white */
        }
    
        .card {
          background-color: #f4a8c7; /* Light pink background for cards */
          border-radius: 10px;
          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
          transition: box-shadow 0.3s ease-in-out;
        }
    
        .card:hover {
          box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
    
        .card-header {
          background-color: #ff4081; /* Pink background for card headers */
          color: #fff;
          font-weight: bold;
        }
    
        .card-body {
          padding: 15px;
        }
    
        .card-text {
          color: #fff; /* Set text color in cards to white */
        }
      </style>
</head>
<body style="background-color: rgb(214, 140, 216)">

<div class="container">
    <h1 class="text-center mt-5">Welcome Back</h1>
    <td>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="btn btn-primary">
            @csrf
    <button type="submit">Logout</button>
        </form>
    
    </td>
    <h1 class="text-center mt-5">Your'sTask Mr. {{auth()->user()->name}}</h1>
    <div class="row mt-4">
        @foreach($statuses as $status)
        <div class="col-sm-2" ondrop="drop(event, '{{strtolower($status->name)}}'),1" ondragover="allowDrop(event)">
            <div class="card task-card">
                <div class="card-header task-card-header">
                    {{$status->name}}
                </div>
                <div class="card-body task-card-body" id="{{strtolower($status->name)}}" ondragover="allowDrop(event)" ondrop="drop(event, '{{strtolower($status->name)}}',1)">
                    <!-- Tasks in Progress -->
                </div>
            </div>
        </div>
@endforeach
                <div class="card-body " id="todo-list">
                    @foreach($userTasks as $index => $task)
                        <div class="task" id="task{{$task->id}}" draggable="true" ondragstart="drag(event)">
                            <p><strong>Id:</strong> {{$task->id}}</p>
                            <p><strong>Title:</strong> {{$task->title}}</p>
                            <p><strong>Description:</strong> {{$task->description}}</p>
                            <p><strong>Priority:</strong>{{$task->priority}}</p>
                            <p><strong>Project:</strong> {{$task->project}}</p>
                            <p><strong>Due Date:</strong> {{$task->due_date}}</p>
                            <hr>
                        </div>
                    @endforeach
                </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script>
    // Function to allow dropping
    function allowDrop(ev) {
        ev.preventDefault();
    }

    // Function to handle dragging
    function drag(ev) {
        console.log(ev)
        ev.dataTransfer.setData("text", ev.target.id);
    }

    // Function to handle dropping
    function drop(ev, targetId,status) {
        console.log(status)
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        var draggedTask = document.getElementById(data);
        var targetColumn = document.getElementById(targetId);
        targetColumn.appendChild(draggedTask);

        // Update task position in local storage
        updateLocalStorage();
    }

    // Function to update local storage
    function updateLocalStorage() {
        var tasks = document.querySelectorAll('.task');
        var taskPositions = [];
        tasks.forEach(function(task) {
            taskPositions.push({
                id: task.id,
                parent: task.parentElement.id
            });
        });
        localStorage.setItem('taskPositions', JSON.stringify(taskPositions));
    }

    // Function to restore task positions from local storage
    function restoreTaskPositions() {
        var taskPositions = localStorage.getItem('taskPositions');
        if (taskPositions) {
            taskPositions = JSON.parse(taskPositions);
            taskPositions.forEach(function(taskPosition) {
                var task = document.getElementById(taskPosition.id);
                var parent = document.getElementById(taskPosition.parent);
                parent.appendChild(task);
            });
        }
    }

    // Restore task positions on page load
    document.addEventListener('DOMContentLoaded', function() {
        restoreTaskPositions();
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Function to handle dropping
    function drop(ev, targetId,status) {
        console.log(targetId)
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        var draggedTask = document.getElementById(data);
        var targetColumn = document.getElementById(targetId);
        targetColumn.appendChild(draggedTask);
                console.log(targetColumn)
        // Extract task ID from the dragged task
          var taskId = data.replace('task', '');
        //   var statusId = data.replace('status', '');
            
        // Send AJAX request to update task status
        fetch('{{ route("tasks_status.update") }}', {
            method: 'POST', // Change method to POST since we are updating data
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Use headers to send CSRF token
            },
            body: JSON.stringify({
                taskId: taskId,
                newStatus: targetId,
                 statusId: status
                

            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
        })
        .catch((error) => {
            console.error('Failed to update task status:', error);
        });
        // Update task position in local storage
        updateLocalStorage();
    }

</script>

</body>
</html>
