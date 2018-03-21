@extends('layouts.master')

@section('title')
Welcome
@endsection

@section('content')
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div id="to-do-list">
  <div class="panel panel-header">
<h1>CHECKLIST</h1>
  </div>
  <div class="panel panel-body">
<todo-form @todo-created="addToDo"></todo-form>
<todo-list :todos="todos"></todo-list>
</div>
</div>
</div>
</div>
</div>

@endsection  

@section('extra-content-bottom')
<script src="{{ asset('js/app.js') }}"></script>
<script>
const STORAGE_KEY = 'todos';

Vue.component('todo-form', {
    template: '<form @submit.prevent="todoEvent"><input type="text" v-model="newToDo">' +
              '<input type="submit" value="Add"></form>',
    data: function () {
            return {
              newToDo: '',
              todos: {id: 0, title: 'New Todo', completed: 'false'}
            }
    },
    methods: {
      todoEvent: function () {
        this.$emit('todo-created', this.newToDo);
        this.newToDo = '';
      }
    }
  });
  
  Vue.component ('todo-list', {
    template: '<ul> <li class="checklist" v-for="todo in todos"><button @click="removeTodo(todo)"><i class="fa fa-trash"></i></button>&nbsp;<input class="toggle" type="checkbox"> @{{ todo.title }}</li></ul>',
    props: ['todos'],
    methods:{
    removeTodo: function (todo){
      this.todos.splice(this.todos.indexOf(todo), 1);
      localStorage.setItem(STORAGE_KEY, JSON.stringify(this.todos));
    },
    }
    });
  
  new Vue ({
    el: '#to-do-list',
    data: {
      'todos': []
    },
    mounted: function () {
    if (localStorage.getItem('todos')) this.todos = JSON.parse(localStorage.getItem('todos'));
  },
    methods: {
      addToDo: function (todo){
        this.todos.push({title: todo, completed: 'false',id:this.todos.length});
        localStorage.setItem(STORAGE_KEY, JSON.stringify(this.todos));
      },
    }
  });
</script>

@endsection