<template>
  <div class="col-md-3">
    <h4>{{ member.name }}</h4>
    <div class="well well-perfil" v-bind:style="{ backgroundColor: member.color }">
      <span>{{ member.name[0] }}</span>
    </div>
  </div>
</template>

<script>
    export default {
      props: ['member'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
