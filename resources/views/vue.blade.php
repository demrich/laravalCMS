@extends('layouts.master')

@section('title')
    Vue
@endsection

@section('content')
<div id="to-do-list">
<h1>Todo App</h1>
<todo-form @todo-created="addToDo"></todo-form>
<todo-list :todos="todos"></todo-list>
</div>
@endsection  

@section('extra-content-bottom')
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">


Vue.component('todo-form', {
  template: '<form @submit.prevent="todoEvent"><input type="text" v-model="newToDo">' +
            '<input type="submit" value="Add"></form>',
  data: function () {
          return {
            newToDo: ''
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
  template: '<ul> <li v-for="todo in todos"> @{{ todo }} </li></ul>',
  props: ['todos']
});

new Vue ({
  el: '#to-do-list',
  data: {
    'todos': []
  },
  methods: {
    addToDo: function (todo){
      this.todos.push(todo);
    }
  }
})
</script>
@endsection