<template>

  
  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8  mt-48">
    <button v-on:click="logout()" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Log Out</button>

<div class="overflow-x-auto relative shadow-md sm:rounded-lg">

    <form v-on:submit.prevent="createtodo()">   
    <div class="relative">
       
        <input type="text" v-model="todo" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Task ">
        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add To do</button>
    </div>
</form>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Sl No 
                </th>
                <th scope="col" class="py-3 px-6">
                   Created By
                </th>
                <th scope="col" class="py-3 px-6">
                    What to do ?
                </th>
                <th scope="col" class="py-3 px-6">
                    It is Done ?
                </th>
                <th scope="col" class="py-3 px-6">
                   Want to delete ?
                </th>
             </tr>
        </thead>
        <tbody>
             <tr v-for="todo in todos" :key="todo.id">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                    {{todo.id}}
                </th>
                <td class="py-4 px-6">
                    {{todo.created_by.name}}
                </td>
                <td class="py-4 px-6">
                    {{todo.content}}
                </td>
                <td class="py-4 px-6">
                    <span v-if="todo.status" >
                        Yes
                    </span>
                    <span v-else>
                        <button class="h-5 w-24 bg-green-600 text-white mx-auto rounded-xl " @click="markread(todo.id)">Mark as done </button>
                    </span>

                </td>
                <td class="py-4 px-6">
                   <button class="h-5 w-16 bg-red-600 text-white mx-auto rounded-xl" @click="deletetodo(todo.id)">Yes </button>
                </td>
              
            </tr>
        </tbody>
    </table>

</div>

</div>
</template>

<script>
import axios from 'axios'
export default {
    name:'Todo',
    data(){
        return {
            todos:[],
            todo:''
        }
    },methods:{
            async gettodos()
            {
              
                try{
                    let result=await axios.get('/api/todolist',{
                        headers:{'Authorization':'Bearer '+localStorage.getItem('authtoken') }
                    });
                    if(result.status===201)
                    {
                        this.todos=result.data;
                    }
                }catch(error){
                   if(error.response.status==401)
                   {
                    this.logout();
                   }
                }   
               

            },
        async createtodo()
            {
                let result= await axios.post('api/createtodo',{
                    todo:this.todo
                });
                if(result.status==200)
                {
                    this.gettodos()
                    this.todo=''
                }else{
                    alert('Something went wrong');
                }
            },
            async markread(id)
            {
                let response= await axios.put('/api/updatetodo/'+id,{read:1});
                if(response.status==200)
                {
                    this.gettodos()
                }else{
                    alert('something went wrong');
                }
            },
            async deletetodo(id)
            {
                let result= await axios.delete('api/delete/'+id);
                if(result.status==200)
                {
                    this.gettodos();
                }else{
                    alert('Something went wrong');
                }
            },
            async logout()
            {
                let response=await axios.get('/api/logout');
                console.log(response);
                localStorage.removeItem('authtoken')
                this.$router.push('/')

            }
    },
    mounted(){
        axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('authtoken');
        this.gettodos()
        if(!localStorage.getItem('authtoken'))
        {
            this.$router.push('/')
        }
    }

}
</script>