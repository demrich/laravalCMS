@extends('layouts.master') @section('title') Welcome @endsection @section('content')
<div class="container">
 
  <div class="row">
    <div class="col-md-3 col-md-offset-4">
      <div id="to-do-list">
        <div class="panel panel-header pa-3 text-center">
          <v-avatar :tile="tile" :size="150" class="grey lighten-4">
            <img src="{{asset('/storage/profile/profile-pic/' . Auth::user()->profile_pic) }}" alt="avatar">
          </v-avatar>
          <h1 class="">Hello,{{ Auth::user()->first_name }}</h1>
        </div>
        <div class="panel panel-body pa-3">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Looks like there is some problems.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(array(
            'route' => 'uploadprofilepic','files'=>true)) !!}
          <h3>Image Upload:</h3>
          {!! Form::file('image', array('class' => 'form-control')) !!}
          <button type="submit" class="btn btn-success">Upload</button>
        {!! Form::close() !!}

        </div>
        <div class="panel panel-body pa-3">
          <h3>To Do List:</h3>
          <todo-form @todo-created="addToDo"></todo-form>
          <todo-list :todos="todos"></todo-list>
        </div>
      </div>
      <div class="panel panel-body">
        <p>
          <a href="{{ route('beatdonation') }}">Beat Donation</a>
        </p>

        @if (Auth::user()->hasRole('admin'))
        <p>Admin:
          <br>
          <a href="{{ route('changeuser') }}">Change User Role</a>
          <br>
          <a href="{{ route('uploadproduct') }}">Upload Product</a>
          <br>
        </p>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection @section('extra-content-bottom')
<script src="{{ asset('js/app.js') }}"></script>
<script>
  const STORAGE_KEY = 'todos';

  Vue.component('todo-form', {
    template: '<form @submit.prevent="todoEvent"><input type="text" v-model="newToDo">' +
      '<input type="submit" value="Add"></form>',
    data: function () {
      return {
        newToDo: '',
        todos: {
          id: 0,
          title: 'New Todo',
          completed: 'false'
        }
      }
    },
    methods: {
      todoEvent: function () {
        this.$emit('todo-created', this.newToDo);
        this.newToDo = '';
      }
    }
  });

  Vue.component('todo-list', {
    template: '<ul> <li class="checklist" v-for="todo in todos"><button @click="removeTodo(todo)"><i class="fa fa-trash"></i></button>&nbsp;<input class="toggle" type="checkbox"> @{{ todo.title }}</li></ul>',
    props: ['todos'],
    methods: {
      removeTodo: function (todo) {
        this.todos.splice(this.todos.indexOf(todo), 1);
        localStorage.setItem(STORAGE_KEY, JSON.stringify(this.todos));
      },
    }
  });

  new Vue({
    el: '#to-do-list',
    data: {
      'todos': []
    },
    mounted: function () {
      if (localStorage.getItem('todos')) this.todos = JSON.parse(localStorage.getItem('todos'));
    },
    methods: {
      addToDo: function (todo) {
        this.todos.push({
          title: todo,
          completed: 'false',
          id: this.todos.length
        });
        localStorage.setItem(STORAGE_KEY, JSON.stringify(this.todos));
      },
    }
  });
</script>

@endsection