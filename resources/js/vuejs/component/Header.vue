<template>
    <div style="font-size: 20px;">
        <router-link to="/taskComponent">taskComponent</router-link> | 
        <router-link to="/create">create</router-link>
        <hr>
        <router-view></router-view>
    </div>
</template>
<script>
export default{
    setup:() => ({
        title:"hello"
    })
}
</script>